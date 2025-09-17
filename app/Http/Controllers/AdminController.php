<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Laporan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        $totalLaporan = Laporan::get()->count();
        $totalBidang = Bidang::get()->count();
        $totalPegawai = User::where('role', 'pegawai')->get()->count();
        $totalWarga = User::where('role', 'warga')->get()->count();
        return view('admin.index', compact('totalLaporan', 'totalBidang', 'totalPegawai', 'totalWarga'));
    }

    public function laporan(Request $request)
    {

        $base = Laporan::with(['bidang', 'user']);
        if ($search = trim((string) $request->get('search'))) {
            $base->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%");
            });
        }

        if ($bidangId = $request->get('bidang_id')) {
            $base->where('bidang_id', $bidangId);
        }
        $forStats = clone $base;
        $stats = [
            'pending'  => (clone $forStats)->where('status_verifikasi', 'pending')->count(),
            'diterima' => (clone $forStats)->where('status_verifikasi', 'diterima')->count(),
            'selesai'  => (clone $forStats)->where('status_verifikasi', 'selesai')->count(),
            'ditolak'  => (clone $forStats)->where('status_verifikasi', 'ditolak')->count(),
        ];
        if ($status = $request->get('status_verifikasi')) {
            $base->where('status_verifikasi', $status);
        }
        switch ($request->get('sort_by')) {
            case 'tanggal_terlama':
                $base->orderBy('tanggal_laporan', 'asc')->orderBy('created_at', 'asc');
                break;
            case 'nama_az':
                $base->orderBy('judul', 'asc');
                break;
            case 'tanggal_terbaru':
            default:
                $base->orderBy('tanggal_laporan', 'desc')->orderBy('created_at', 'desc');
                break;
        }
        $laporans = $base->paginate(10)->withQueryString();
        $bidangs = Bidang::orderBy('nama')->get();

        return view('admin.laporan', compact('laporans', 'stats', 'bidangs'));
    }
    public function detailLaporan($id)
    {
        $laporan = Laporan::find($id);
        return view('admin.detail.laporan', compact('laporan'));
    }

    public function storeBidang(Request $request)
    {
        // Validasi
        $validated = $request->validate(
            [
                'nama' => [
                    'required',
                    'string',
                    'max:255',
                    'unique:bidangs,nama',
                ],
                'ketua_id' => [
                    'nullable',
                    Rule::exists('users', 'id')->where(fn($q) => $q->where('role', 'ketua_bidang')),
                    Rule::unique('bidangs', 'ketua_id'),
                ],
            ],
            [],
            [
                'nama' => 'Nama Bidang',
                'ketua_id' => 'Ketua Bidang',
            ]
        );

        DB::transaction(function () use ($validated) {
            Bidang::create($validated);
        });

        return redirect()
            ->route('admin.bidang')
            ->with('success', 'Bidang berhasil ditambahkan.');
    }

    public function bidang()
    {
        $bidangs = Bidang::with('ketua')->paginate(10);

        $users = User::where('role', 'ketua_bidang')
            ->whereDoesntHave('bidangKetua')
            ->orderBy('name') 
            ->get();

        return view('admin.bidang', compact('bidangs', 'users'));
    }


    public function showBidang($id)
    {
        $bidang = Bidang::with([
            'ketua',
            'timRutins',
            'laporans',
        ])->findOrFail($id);
        return view('admin.detail.bidang', compact('bidang'));
    }

    public function destroyBidang($id)
    {
        $bidang = Bidang::findOrFail($id);
        $bidang->delete();
        return redirect()->route('admin.bidang')->with('success', 'Bidang berhasil dihapus');
    }

    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.kelola-user', compact('users'));
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name'           => ['required', 'string', 'max:255'],
            'email'          => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password'       => ['required', 'string', 'min:6'],
            'role'           => ['required', Rule::in(['Admin', 'Ketua Bidang', 'Pegawai', 'Warga'])],
            'alamat'         => ['nullable', 'string', 'max:255'],
            'no_telepon'     => ['nullable', 'string', 'max:50'],
            'jenis_kelamin'  => ['nullable', Rule::in(['L', 'P', 'Laki-laki', 'Perempuan'])],
            'tanggal_lahir'  => ['nullable', 'date'],
        ], [], [
            'name'          => 'Nama',
            'email'         => 'Email',
            'password'      => 'Password',
            'role'          => 'Role',
            'alamat'        => 'Alamat',
            'no_telepon'    => 'No. Telepon',
            'jenis_kelamin' => 'Jenis Kelamin',
            'tanggal_lahir' => 'Tanggal Lahir',
        ]);

        $user = User::create($validated);

        return redirect()
            ->route('admin.users')
            ->with('success', 'User berhasil ditambahkan.');
    }

    public function detailUser($id)
    {
        $user = User::find($id);
        return view('admin.detail.user', compact('user'));
    }
    public function destroyUser(User $user)
    {

        if ($user->bidangKetua()->exists()) {
            return back()->withErrors([
                'error' => 'Tidak dapat menghapus user: masih menjadi Ketua pada salah satu Bidang. Pindahkan ketua bidang terlebih dahulu.'
            ]);
        }

        if ($user->timRutinDipegang()->exists() || $user->timNonRutinDipegang()->exists()) {
            return back()->withErrors([
                'error' => 'Tidak dapat menghapus user: masih menjadi penanggung jawab pada tim. Pindahkan penanggung jawab terlebih dahulu.'
            ]);
        }

        $user->timRutin()->detach();
        $user->timNonRutin()->detach();


        $user->delete();

        return redirect()
            ->route('admin.users')
            ->with('success', 'User berhasil dihapus.');
    }
}
