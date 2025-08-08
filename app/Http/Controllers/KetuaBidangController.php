<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\TimNonRutin;
use App\Models\TimRutin;
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
        $users = User::where('bidang_id', auth()->user()->bidang_id)->get();
        $timRutin = TimRutin::where('bidang_id', auth()->user()->bidang_id)->get();
        return view('ketua-bidang.tim', compact('users', 'timRutin'));
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

    public function timRutinShow($id)
    {
        $timRutin = TimRutin::find($id);
        return view('ketua-bidang.detail.tim-rutin', compact('timRutin'));
    }

    public function timNonRutinStore(Request $request) {}

    public function detailTim()
    {

        return view('ketua-bidang.detail-tim');
    }

    public function laporan()
    {
        return view('ketua-bidang.laporan-warga');
    }

    public function review()
    {
        return view('ketua-bidang.review');
    }
}
