<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class WargaController extends Controller
{
    public function index()
    {
        $laporanSaya = Laporan::where('pelapor_id', auth()->id())->count();
        $recent_reports = Laporan::where('pelapor_id', auth()->id())->latest()->take(5)->get();
        $laporanPending = Laporan::where('pelapor_id', auth()->id())
            ->where('status_verifikasi', 'pending')
            ->count();

        $laporanSelesai = Laporan::where('pelapor_id', auth()->id())
            ->where('status_verifikasi', 'selesai')
            ->count();

        $rataSelesai = $laporanSaya > 0
            ? ($laporanSelesai / $laporanSaya) * 100
            : 0;


        return view('warga.index', compact('laporanSaya', 'laporanPending', 'laporanSelesai', 'rataSelesai', 'recent_reports'));
    }

    public function detailLaporan($id)
    {
        $laporan = Laporan::where('id', $id)->with('user')->first();
        return view('warga.detail.laporan', compact('laporan'));
    }


    public function profile()
    {
        return view('warga.edit-profile');
    }

    public function laporan(Request $request)
    {
        $query = Laporan::where('pelapor_id', auth()->id())
            ->with('user')
            ->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }


        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->search . '%')
                    ->orWhere('lokasi', 'like', '%' . $request->search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
            });
        }

        $laporan = $query->paginate(10);

        return view('warga.tracking-laporan', compact('laporan'));
    }

    public function buatLaporan()
    {
        $bidangs = Bidang::all();
        return view('warga.buat-laporan', compact('bidangs'));
    }


    public function storeLaporan(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'judul'              => ['required', 'string', 'max:255'],
            'deskripsi'          => ['required', 'string'],
            'kategori_fasilitas' => ['required', Rule::in(['jalan', 'trotoar', 'lampu_jalan', 'taman_kota', 'saluran_air', 'lainnya'])],
            'jenis_kerusakan'    => ['nullable', 'string', 'max:100'],

            'alamat'    => ['required', 'string', 'max:255'],
            'kecamatan' => ['nullable', 'string', 'max:100'],
            'kelurahan' => ['nullable', 'string', 'max:100'],
            'latitude'  => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],

            'foto'            => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'lampiran.*'      => ['nullable', 'file', 'max:5120'], // opsional, jika pakai tabel lampiran

            'is_anonim'      => ['sometimes', 'boolean'],
            'nama_pelapor'   => ['required_unless:is_anonim,1', 'string', 'max:100'],
            'kontak_pelapor' => ['nullable', 'string', 'max:50'],

            // status boleh tidak dikirim (pakai default)
            'status_verifikasi' => ['sometimes', Rule::in(['pending', 'diterima', 'ditolak'])],
            'status_penanganan' => ['sometimes', Rule::in(['menunggu', 'diproses', 'selesai', 'ditunda'])],

            // penanggung jawab internal
            'bidang_id' => ['required', 'exists:bidangs,id'],            
        ]);

        $isAnonim  = (bool) ($validated['is_anonim'] ?? false);
        $pelaporId = (!$isAnonim && Auth::check()) ? Auth::id() : null;

        // Upload foto bukti (jika ada)
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('laporan/foto', 'public');
        }

        // Simpan ke DB (pakai transaksi + lampiran opsional)
        $laporan = DB::transaction(function () use ($validated, $isAnonim, $pelaporId, $fotoPath, $request) {
            $laporan = Laporan::create([
                'kode_laporan'      => $this->generateKodeLaporan(),
                'judul'             => $validated['judul'],
                'deskripsi'         => $validated['deskripsi'],
                'kategori_fasilitas' => $validated['kategori_fasilitas'],
                'jenis_kerusakan'   => $validated['jenis_kerusakan'] ?? null,
                'alamat'    => $validated['alamat'],
                'kecamatan' => $validated['kecamatan'] ?? null,
                'kelurahan' => $validated['kelurahan'] ?? null,
                'latitude'  => $validated['latitude'] ?? null,
                'longitude' => $validated['longitude'] ?? null,
                'foto'       => $fotoPath,
                'pelapor_id' => $pelaporId,
                'is_anonim'  => $isAnonim,
                'nama_pelapor'   => $isAnonim ? 'Anonim' : $validated['nama_pelapor'],
                'kontak_pelapor' => $isAnonim ? null : ($validated['kontak_pelapor'] ?? null),

                'status_verifikasi' => $validated['status_verifikasi'] ?? 'pending',
                'status_penanganan' => $validated['status_penanganan'] ?? 'menunggu',

                'tanggal_laporan' => now(),
                'bidang_id'       => $validated['bidang_id'],
                
            ]);
            

            return $laporan;
        });
        return redirect()
            ->route('home', $laporan->id)
            ->with('success', 'Laporan berhasil dikirim. Terima kasih atas partisipasi Anda!');
    }
    private function generateKodeLaporan(): string
    {
        do {
            $code = 'LPR-' . now()->format('Ymd') . '-' . str_pad((string)random_int(0, 9999), 4, '0', STR_PAD_LEFT);
        } while (Laporan::where('kode_laporan', $code)->exists());

        return $code;
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name'          => 'nullable|string|max:255',
            'email'         => 'nullable|string|email|max:255|unique:users,email,' . auth()->id(),
            'alamat'        => 'nullable|string|max:255',
            'no_telepon'    => 'nullable|string|max:255',
            'jenis_kelamin' => 'nullable|in:Laki-Laki,Perempuan',
            'tanggal_lahir' => 'nullable|date',
            'password'      => 'nullable|min:6|confirmed',
        ]);

        $user = auth()->user();

        $data = array_filter($request->only([
            'name',
            'email',
            'alamat',
            'no_telepon',
            'jenis_kelamin',
            'tanggal_lahir',
        ]), fn($value) => $value !== null && $value !== '');

        // Jika password diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('warga.profile')->with('success', 'Profil berhasil diperbarui!');
    }


}
