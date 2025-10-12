<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Laporan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
          $bidangs = Bidang::orderBy('nama')->get();
        return view('admin.kelola-user', compact('users', 'bidangs'));
    }


public function storeUser(Request $request)
{
    $validated = $request->validate([
        'name'           => ['required', 'string', 'max:255'],
        'nip'            => ['required', 'string', 'max:50', 'unique:users,nip'],
        'email'          => ['required', 'string', 'email', 'lowercase', 'max:255', 'unique:users,email'],
        'password'       => ['required', 'string', 'min:6'],
        'role'           => ['required', Rule::in(['admin', 'ketua_bidang', 'pegawai', 'warga', 'kepala_dinas'])],
        'alamat'         => ['nullable', 'string', 'max:255'],
        'no_telepon'     => ['nullable', 'string', 'max:50'],
        // migration menyimpan 'Laki-Laki' / 'Perempuan'
        'jenis_kelamin'  => ['nullable', Rule::in(['L', 'P', 'Laki-Laki', 'Perempuan'])],
        'tanggal_lahir'  => ['nullable', 'date'],
        'bidang_id'      => ['nullable', 'integer', 'exists:bidangs,id'], // opsional
    ], [], [
        'name'          => 'Nama',
        'nip'           => 'NIP',
        'email'         => 'Email',
        'password'      => 'Password',
        'role'          => 'Role',
        'alamat'        => 'Alamat',
        'no_telepon'    => 'No. Telepon',
        'jenis_kelamin' => 'Jenis Kelamin',
        'tanggal_lahir' => 'Tanggal Lahir',
        'bidang_id'     => 'Bidang',
    ]);

    // Samakan ke format enum di migration: 'Laki-Laki' / 'Perempuan'
    $jk = $request->input('jenis_kelamin');
    if (in_array($jk, ['L', 'Laki-laki', 'l', 'laki-laki'])) $jk = 'Laki-Laki';
    if (in_array($jk, ['P', 'Perempuan', 'p'])) $jk = 'Perempuan';

    $data = [
        'name'          => trim($validated['name']),
        'nip'           => trim($validated['nip']),
        'email'         => strtolower(trim($validated['email'])),
        'password'      => Hash::make($validated['password']),
        'role'          => $validated['role'],
        'alamat'        => $validated['alamat'] ?? null,
        'no_telepon'    => $validated['no_telepon'] ?? null,
        'jenis_kelamin' => $jk ?? null,
        'tanggal_lahir' => $validated['tanggal_lahir'] ?? null,
        'bidang_id'     => $validated['bidang_id'] ?? null,
    ];

    $user = User::create($data);

    return redirect()->route('admin.users')->with('success', 'User berhasil ditambahkan.');
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
    public function updateUser(Request $request, User $user)
{
    // Validasi dasar
    $rules = [
        'name'          => ['required', 'string', 'max:255'],
        'email'         => ['required', 'string', 'email', 'lowercase', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
        'nip'           => ['nullable', 'string', 'max:50', Rule::unique('users', 'nip')->ignore($user->id)],
        'password'      => ['nullable', 'string', 'min:6'], // opsional
        'role'          => ['required', Rule::in(['admin','ketua_bidang','pegawai','warga','kepala_dinas'])],
        'alamat'        => ['nullable', 'string', 'max:255'],
        'no_telepon'    => ['nullable', 'string', 'max:50'],
        'jenis_kelamin' => ['nullable', Rule::in(['L','P','Laki-Laki','Perempuan'])],
        'tanggal_lahir' => ['nullable', 'date'],
        'bidang_id'     => ['nullable', 'integer', 'exists:bidangs,id'],
    ];

    // Jika role pegawai/ketua_bidang, wajib pilih bidang
    $role = $request->input('role');
    if (in_array($role, ['pegawai','ketua_bidang'])) {
        $rules['bidang_id'] = ['required', 'integer', 'exists:bidangs,id'];
    }

    $messages = []; // pakai default sudah cukup, kamu sudah punya label di storeUser

    $validated = $request->validate($rules, $messages);

    // Normalisasi jenis kelamin ke enum migration
    $jk = $validated['jenis_kelamin'] ?? null;
    if ($jk) {
        if (in_array($jk, ['L', 'Laki-laki', 'l', 'laki-laki'])) $jk = 'Laki-Laki';
        if (in_array($jk, ['P', 'Perempuan', 'p'])) $jk = 'Perempuan';
    }

    // Lindungi diri sendiri: opsional—mis. larang turunkan role sendiri
    if ($user->id === auth()->id() && $user->role !== $role) {
        return back()->withErrors(['error' => 'Anda tidak dapat mengubah peran akun Anda sendiri.'])
                     ->withInput($request->except('password') + ['form_type' => 'user_edit']);
    }

    // Siapkan payload update
    $payload = [
        'name'          => trim($validated['name']),
        'email'         => strtolower(trim($validated['email'])),
        'role'          => $validated['role'],
        'alamat'        => $validated['alamat'] ?? null,
        'no_telepon'    => $validated['no_telepon'] ?? null,
        'jenis_kelamin' => $jk,
        'tanggal_lahir' => $validated['tanggal_lahir'] ?? null,
        'bidang_id'     => $validated['bidang_id'] ?? null,
    ];
    // NIP opsional
    if (array_key_exists('nip', $validated)) {
        $payload['nip'] = $validated['nip'];
    }
    // Password opsional
    if ($request->filled('password')) {
        $payload['password'] = Hash::make($validated['password']);
    }

    $user->update($payload);

    return redirect()->route('admin.users')->with('success', 'User berhasil diperbarui.');
}

}
