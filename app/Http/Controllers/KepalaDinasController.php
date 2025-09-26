<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\LaporanNonRutin;
use App\Models\TimNonRutin;
use App\Models\TimRutin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class KepalaDinasController extends Controller
{
    public function index()
    {
        
        $laporanBidang = Laporan::get()->count();
        $timRutin = TimRutin::get()->count();
        $timNonRutin = TimNonRutin::get()->count();
        $laporanSelesai = Laporan::where('status_verifikasi', 'selesai')->get()->count();
        return view('kepala_dinas.index', compact('laporanBidang', 'timRutin', 'timNonRutin', 'laporanSelesai'));
    }

    public function laporan() {

        $laporans = Laporan::orderBy('created_at', 'desc')->paginate(10);

  
        $counts = Laporan::select('status_verifikasi', DB::raw('COUNT(*) AS total'))
            ->groupBy('status_verifikasi')
            ->pluck('total', 'status_verifikasi');
        $stats = [
            'pending' => $laporans->where('status_verifikasi', 'pending')->count(),
            'diterima' => $laporans->where('status_verifikasi', 'diterima')->count(),
            'selesai' => $laporans->where('status_verifikasi', 'selesai')->count(),
            'ditolak' => $laporans->where('status_verifikasi', 'ditolak')->count(),
        ];
        return view('kepala_dinas.laporan', compact('laporans', 'stats'));
    }

    public function report(Request $request){
            $base = LaporanNonRutin::with([
            'timNonRutin:id,nama_tim,penanggung_jawab_id,bidang_id',
            'timNonRutin.penanggungJawab:id,name,email',
            'laporan:id,judul,kode_laporan,alamat,status_verifikasi,status_penanganan,tanggal_selesai',
            'penanggungJawab:id,name,email',
        ])
            ->whereHas('timNonRutin', function ($q) {
                $q->where('bidang_id', Auth::user()->bidang_id);
            });


        if (Schema::hasColumn('laporan_non_rutins', 'status_review')) {
            if ($request->filled('status_review')) {
                $base->where('status_review', $request->string('status_review'));
            }
        }


        if ($request->filled('search')) {
            $s = '%' . $request->string('search')->toString() . '%';
            $base->where(function ($q) use ($s) {
                $q->whereHas('laporan', fn($qq) => $qq->where('judul', 'like', $s))
                    ->orWhereHas('timNonRutin', fn($qq) => $qq->where('nama_tim', 'like', $s))
                    ->orWhereHas('penanggungJawab', fn($qq) => $qq->where('name', 'like', $s));
            });
        }


        $total = (clone $base)->count();
        $approved = $needsRevision = $pending = 0;
        if (Schema::hasColumn('laporan_non_rutins', 'status_review')) {
            $approved      = (clone $base)->where('status_review', 'approved')->count();
            $needsRevision = (clone $base)->where('status_review', 'revision')->count();
            $pending       = $total - $approved - $needsRevision;
        } else {

            $pending = $total;
        }


        $laporanTugas = $base->latest()->paginate(12)->withQueryString();

        $stats = [
            'total_reports'  => $total,
            'pending_review' => $pending,
            'approved'       => $approved,
            'needs_revision' => $needsRevision,
        ];

        return view('kepala_dinas.report', compact('laporanTugas', 'stats'));
    }

    public function tim(){
           $busyPJ = TimNonRutin::where('bidang_id', Auth::user()->bidang_id)
            ->whereHas('laporan', function ($q) {
                $q->whereIn('status_penanganan', ['menunggu', 'diproses', 'ditunda']); // ≠ selesai
            })
            ->pluck('penanggung_jawab_id')
            ->filter()
            ->unique()
            ->toArray();


        $users = User::where('bidang_id', Auth::user()->bidang_id)
            ->whereNotIn('id', $busyPJ)
            ->where(function ($q) {

                $q->whereNull('role')->orWhere('role', '!=', 'ketua_bidang');
            })

            ->orderBy('name')
            ->get();

        $timRutin   = TimRutin::where('bidang_id', Auth::user()->bidang_id)->get();
        $timNonRutin = TimNonRutin::where('bidang_id', Auth::user()->bidang_id)->get();
        $laporans   = Laporan::where('bidang_id', Auth::user()->bidang_id)->get();

        return view('kepala_dinas.tim', compact('users', 'timRutin', 'timNonRutin', 'laporans'));
    }
}
