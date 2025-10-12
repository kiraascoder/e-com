<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
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

    public function laporan()
    {
        $laporans = Laporan::orderBy('created_at', 'desc')->paginate(10);

        $counts = Laporan::select('status_verifikasi', DB::raw('COUNT(*) AS total'))->groupBy('status_verifikasi')->pluck('total', 'status_verifikasi');
        $stats = [
            'pending' => $laporans->where('status_verifikasi', 'pending')->count(),
            'diterima' => $laporans->where('status_verifikasi', 'diterima')->count(),
            'selesai' => $laporans->where('status_verifikasi', 'selesai')->count(),
            'ditolak' => $laporans->where('status_verifikasi', 'ditolak')->count(),
        ];
        return view('kepala_dinas.laporan', compact('laporans', 'stats'));
    }

    public function report(Request $request)
    {
        // Ambil SEMUA data non-rutin (tanpa menyesuaikan bidang)
        $base = LaporanNonRutin::with(['timNonRutin:id,nama_tim,penanggung_jawab_id,bidang_id', 'timNonRutin.penanggungJawab:id,name,email', 'laporan:id,judul,kode_laporan,alamat,status_verifikasi,status_penanganan,tanggal_selesai', 'penanggungJawab:id,name,email']);

        // Opsional: filter status_review bila kolom ada & request diisi
        if (Schema::hasColumn('laporan_non_rutins', 'status_review') && $request->filled('status_review')) {
            $base->where('status_review', $request->string('status_review'));
        }

        // Pencarian: judul laporan, nama tim, atau nama PJ
        if ($request->filled('search')) {
            $s = '%' . $request->string('search')->toString() . '%';
            $base->where(function ($q) use ($s) {
                $q->whereHas('laporan', fn($qq) => $qq->where('judul', 'like', $s))->orWhereHas('timNonRutin', fn($qq) => $qq->where('nama_tim', 'like', $s))->orWhereHas('penanggungJawab', fn($qq) => $qq->where('name', 'like', $s));
            });
        }

        // Statistik
        $total = (clone $base)->count();
        $approved = $needsRevision = $pending = 0;

        if (Schema::hasColumn('laporan_non_rutins', 'status_review')) {
            $approved = (clone $base)->where('status_review', 'approved')->count();
            $needsRevision = (clone $base)->where('status_review', 'revision')->count();
            $pending = $total - $approved - $needsRevision;
        } else {
            $pending = $total;
        }

        // Data untuk tabel (terbaru dulu)
        $laporanTugas = $base->latest()->paginate(12)->withQueryString();

        $stats = [
            'total_reports' => $total,
            'pending_review' => $pending,
            'approved' => $approved,
            'needs_revision' => $needsRevision,
        ];

        return view('kepala_dinas.report', compact('laporanTugas', 'stats'));
    }

    public function tim()
    {
        // PJ yang sedang sibuk pada tim non-rutin (dari SEMUA bidang)
        $busyPJ = TimNonRutin::whereHas('laporan', function ($q) {
            $q->whereIn('status_penanganan', ['menunggu', 'diproses', 'ditunda']); // ≠ selesai
        })
            ->pluck('penanggung_jawab_id')
            ->filter()
            ->unique()
            ->toArray();

        // Semua user (tanpa filter bidang), kecuali yang sedang jadi PJ aktif & bukan ketua_bidang
        $users = User::when(!empty($busyPJ), function ($q) use ($busyPJ) {
            $q->whereNotIn('id', $busyPJ);
        })
            ->where(function ($q) {
                $q->whereNull('role')->orWhere('role', '!=', 'ketua_bidang');
            })
            ->orderBy('name')
            ->get();

        // Ambil semua tim (tanpa filter bidang)
        $timRutin = TimRutin::latest()->get();
        $timNonRutin = TimNonRutin::latest()->get();

        // Ambil semua laporan (tanpa filter bidang)
        $laporans = Laporan::latest()->get();

        return view('kepala_dinas.tim', compact('users', 'timRutin', 'timNonRutin', 'laporans'));
    }
    public function timRutinShow($id)
    {
        $timRutin = TimRutin::find($id);
        $query = User::where('bidang_id', Auth::user()->bidang_id);
        $query->where('id', '!=', $timRutin->penanggung_jawab_id);
        $anggotaNonRutin = DB::table('tim_non_rutin_user')->pluck('user_id');
        $anggotaRutin = DB::table('tim_rutin_user')->pluck('user_id');
        $users = $query->whereNotIn('id', $anggotaNonRutin)->whereNotIn('id', $anggotaRutin)->orderBy('name')->get();
        $timRutinAnggota = TimRutin::with(['anggota', 'penanggungJawab'])->findOrFail($id);
        $anggotaTim = User::orderBy('name')->get();
        return view('kepala_dinas.detail.tim-rutin', compact('timRutin', 'users', 'anggotaTim', 'timRutinAnggota'));
    }
    public function timNonRutinShow($id)
    {
        $timNonRutin = TimNonRutin::find($id);
        $query = User::where('bidang_id', Auth::user()->bidang_id);
        $query->where('id', '!=', $timNonRutin->penanggung_jawab_id);
        $anggotaNonRutin = DB::table('tim_non_rutin_user')->pluck('user_id');
        $anggotaRutin = DB::table('tim_rutin_user')->pluck('user_id');
        $users = $query->whereNotIn('id', $anggotaNonRutin)->whereNotIn('id', $anggotaRutin)->orderBy('name')->get();
        $timNonRutinAnggota = TimNonRutin::with(['anggota', 'penanggungJawab'])->findOrFail($id);
        $anggotaTim = User::orderBy('name')->get();
        return view('kepala_dinas.detail.tim-nonrutin', compact('timNonRutin', 'users', 'anggotaTim', 'timNonRutinAnggota'));
    }
    public function detailLaporan($id)
    {
        $laporan = Laporan::find($id);
        $bidangs = Bidang::all();
        return view('kepala_dinas.detail.laporan', compact('laporan', 'bidangs'));
    }

    public function showReview(LaporanNonRutin $laporanTugas)
    {
        // Jika pakai route model binding ($laporanTugas) kamu tidak perlu lagi findOrFail($id)
        $laporanTugas->loadMissing(['timNonRutin:id,nama_tim,penanggung_jawab_id,bidang_id,deskripsi,created_at', 'timNonRutin.penanggungJawab:id,name,email', 'laporan:id,judul,kode_laporan,alamat,status_verifikasi,status_penanganan,tanggal_selesai,foto', 'penanggungJawab:id,name,email']);

        // Batasi hanya kalau user adalah ketua_bidang
        if (Auth::user()->role === 'ketua_bidang') {
            abort_unless(optional($laporanTugas->timNonRutin)->bidang_id === Auth::user()->bidang_id, 403);
        }

        // Kepala dinas tidak dibatasi bidang
        return view('kepala_dinas.detail.report', compact('laporanTugas'));
    }
          public function destroyLaporan($id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->delete();
        return redirect()->route('dinas.dashboard')->with('success', 'Laporan berhasil dihapus');
    }
}
