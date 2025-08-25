<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\TimNonRutin;
use App\Models\TimRutin;
use App\Models\TimRutinUsers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KetuaBidangController extends Controller
{
    public function index()
    {
        $laporanBidang = Laporan::get()->count();
        $timRutin = TimRutin::get()->count();
        $timNonRutin = TimNonRutin::get()->count();
        $laporanSelesai = Laporan::where('status_verifikasi', 'selesai')->get()->count();
        return view('ketua-bidang.index', compact('laporanBidang', 'timRutin', 'timNonRutin', 'laporanSelesai'));
    }

    public function tim()
    {
        $usedPJ = TimNonRutin::pluck('penanggung_jawab_id')->filter();
        $users = User::where('bidang_id', Auth::user()->bidang_id)
            ->whereNotIn('id', $usedPJ)
            ->orderBy('name')
            ->get();
        $timRutin = TimRutin::where('bidang_id', Auth::user()->bidang_id)->get();
        $timNonRutin = TimNonRutin::where('bidang_id', Auth::user()->bidang_id)->get();
        $laporans = Laporan::where('bidang_id', Auth::user()->bidang_id)->get();
        return view('ketua-bidang.tim', compact('users', 'timRutin', 'timNonRutin', 'laporans'));
    }

    public function timRutinStore(Request $request)
    {
        $request->validate([
            'nama_tim' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'penanggung_jawab_id' => 'required|exists:users,id',
            'jadwal_pelaksanaan' => 'required|string',
        ], [
            'nama_tim.required' => 'Nama Tim wajib diisi',
            'deskripsi.required' => 'Deskripsi wajib diisi',
            'jadwal_pelaksanaan.required' => 'Jadwal Pelaksanaan wajib diisi',
            'penanggung_jawab_id.required' => 'Penanggung Jawab wajib diisi',
        ]);

        TimRutin::create([
            'nama_tim' => $request->nama_tim,
            'deskripsi' => $request->deskripsi,
            'jadwal_pelaksanaan' => $request->jadwal_pelaksanaan,
            'bidang_id' => Auth::user()->bidang_id, // ambil dari user login
            'penanggung_jawab_id' => $request->penanggung_jawab_id,
        ]);

        return redirect()
            ->route('ketua.tim')
            ->with('success', 'Tim Rutin berhasil dibuat');
    }


    public function timRutinDestroy($id)
    {
        TimRutin::find($id)->delete();
        return redirect()
            ->route('ketua.tim')
            ->with('success', 'Tim Rutin berhasil dihapus');
    }
    public function timNonRutinDestroy($id)
    {
        TimNonRutin::find($id)->delete();
        return redirect()
            ->route('ketua.tim')
            ->with('success', 'Tim Non Rutin berhasil dihapus');
    }

    public function timRutinShow($id)
    {
        $timRutin = TimRutin::find($id);
        $users = User::where('bidang_id', Auth::user()->bidang_id)->get();
        $timRutinAnggota = TimRutin::with(['anggota', 'penanggungJawab'])->findOrFail($id);
        $anggotaTim = User::orderBy('name')->get();
        return view('ketua-bidang.detail.tim-rutin', compact('timRutin', 'users', 'anggotaTim', 'timRutinAnggota'));
    }
    public function timNonRutinShow($id)
    {
        $timNonRutin = TimNonRutin::find($id);
        $users = User::where('bidang_id', Auth::user()->bidang_id)->get();
        $timNonRutinAnggota = TimNonRutin::with(['anggota', 'penanggungJawab'])->findOrFail($id);
        $anggotaTim = User::orderBy('name')->get();
        return view('ketua-bidang.detail.tim-nonrutin', compact('timNonRutin', 'users', 'anggotaTim', 'timNonRutinAnggota'));
    }
    public function detailLaporan($id)
    {
        $laporan = Laporan::find($id);
        return view('ketua-bidang.detail.laporan', compact('laporan'));
    }

    public function timNonRutinStore(Request $request)
    {
        $request->validate([
            'nama_tim' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'penanggung_jawab_id' => 'required|exists:users,id',
            'laporan_id' => 'required|exists:laporans,id',
        ], [
            'nama_tim.required' => 'Nama Tim wajib diisi',
            'deskripsi.required' => 'Deskripsi wajib diisi',
            'laporan_id.required' => 'Laporan yang ditangani wajib diisi',
            'penanggung_jawab_id.required' => 'Penanggung Jawab wajib diisi',
        ]);

        TimNonRutin::create([
            'nama_tim' => $request->nama_tim,
            'deskripsi' => $request->deskripsi,
            'bidang_id' => Auth::user()->bidang_id,
            'penanggung_jawab_id' => $request->penanggung_jawab_id,
            'laporan_id' => $request->laporan_id
        ]);

        return redirect()
            ->route('ketua.tim')
            ->with('success', 'Tim Rutin berhasil dibuat');
    }

    public function detailTim()
    {

        return view('ketua-bidang.detail-tim');
    }

    public function laporan()
    {
        $laporans = Laporan::where('bidang_id', Auth::user()->bidang_id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        $stats = [
            'pending' => $laporans->where('status_verifikasi', 'pending')->count(),
            'diterima' => $laporans->where('status_verifikasi', 'diterima')->count(),
            'selesai' => $laporans->where('status_verifikasi', 'selesai')->count(),
            'ditolak' => $laporans->where('status_verifikasi', 'ditolak')->count(),
        ];
        return view('ketua-bidang.laporan-warga', compact('laporans', 'stats'));
    }

    public function review()
    {
        return view('ketua-bidang.review');
    }

    public function storeAnggotaRutin(Request $request, $timId)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ], [
            'user_id.required' => 'Silahkan Pilih Pegawai yang ingin ditambahkan'
        ]);

        TimRutinUsers::create([
            'user_id' => $request->user_id,
            'tim_rutin_id' => $timId
        ]);

        return redirect()
            ->route('ketua.rutin.show', [$timId])
            ->with('success', 'Anggota berhasil ditambahkan');
    }
}
