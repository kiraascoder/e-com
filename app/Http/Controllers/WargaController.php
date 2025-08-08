<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'alamat' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'bidang_id' => 'required|exists:bidangs,id',
            'nama_pelapor' => 'required|string|max:255',
            'kontak_pelapor' => 'required|string|max:255',
            'tanggal_laporan' => 'required|date',
        ], [
            'judul.required' => 'Judul wajib diisi',
            'judul.max' => 'Judul tidak boleh lebih dari 255 karakter',
            'deskripsi.required' => 'Deskripsi wajib diisi',
            'deskripsi.max' => 'Deskripsi tidak boleh lebih dari 255 karakter',
            'alamat.required' => 'Alamat wajib diisi',
            'foto.required' => 'Foto wajib diisi',
            'foto.image' => 'Foto harus berupa gambar',
            'foto.mimes' => 'Format gambar tidak valid',
            'foto.max' => 'Ukuran gambar maksimal 2MB',
            'bidang_id.required' => 'Bidang wajib diisi',
            'nama_pelapor.required' => 'Nama pelapor wajib diisi',
            'kontak_pelapor.required' => 'Kontak pelapor wajib diisi',
            'tanggal_laporan.required' => 'Tanggal laporan wajib diisi',

        ]);

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoName = time() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('images'), $fotoName);
        }

        $laporan = Laporan::create([
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'alamat' => $request->input('alamat'),
            'foto' => $fotoName,
            'bidang_id' => $request->input('bidang_id'),
            'nama_pelapor' => $request->input('nama_pelapor'),
            'kontak_pelapor' => $request->input('kontak_pelapor'),
            'tanggal_laporan' => $request->input('tanggal_laporan'),
            'pelapor_id' => auth()->id(),
        ]);

        $laporan->save();

        return redirect()->route('warga.dashboard')->with('success', 'Laporan berhasil dibuat!');
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
