<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\LaporanNonRutin;
use App\Models\TimNonRutin;
use App\Models\TimNonRutinUsers;
use App\Models\TimRutin;
use App\Models\TimRutinUsers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

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
        $query = User::where('bidang_id', Auth::user()->bidang_id);
        $query->where('id', '!=', $timRutin->penanggung_jawab_id);
        $anggotaNonRutin = DB::table('tim_non_rutin_user')->pluck('user_id');
        $anggotaRutin = DB::table('tim_rutin_user')->pluck('user_id');
        $users = $query->whereNotIn('id', $anggotaNonRutin)
            ->whereNotIn('id', $anggotaRutin)
            ->orderBy('name')
            ->get();
        $timRutinAnggota = TimRutin::with(['anggota', 'penanggungJawab'])->findOrFail($id);
        $anggotaTim = User::orderBy('name')->get();
        return view('ketua-bidang.detail.tim-rutin', compact('timRutin', 'users', 'anggotaTim', 'timRutinAnggota'));
    }
    public function timNonRutinShow($id)
    {
        $timNonRutin = TimNonRutin::find($id);
        $query = User::where('bidang_id', Auth::user()->bidang_id);
        $query->where('id', '!=', $timNonRutin->penanggung_jawab_id);
        $anggotaNonRutin = DB::table('tim_non_rutin_user')->pluck('user_id');
        $anggotaRutin = DB::table('tim_rutin_user')->pluck('user_id');
        $users = $query->whereNotIn('id', $anggotaNonRutin)
            ->whereNotIn('id', $anggotaRutin)
            ->orderBy('name')
            ->get();
        $timNonRutinAnggota = TimNonRutin::with(['anggota', 'penanggungJawab'])->findOrFail($id);
        $anggotaTim = User::orderBy('name')->get();
        return view('ketua-bidang.detail.tim-nonrutin', compact('timNonRutin', 'users', 'anggotaTim', 'timNonRutinAnggota'));
    }
    public function show(Request $request, Laporan $laporan)
    {
        // Eager load relasi yang dibutuhkan modal
        $laporan->load([
            'bidang:id,nama',
        ]);

        // Siapkan payload dengan field terformat
        $data = $laporan->toArray(); // sudah termasuk $appends: foto_url, koordinat
        $data['tanggal_laporan_formatted'] = optional($laporan->tanggal_laporan)->format('d M Y H:i');
        $data['tanggal_selesai_formatted'] = optional($laporan->tanggal_selesai)->format('d M Y H:i');

        return response()->json([
            'success' => true,
            'laporan' => $data,
        ]);
    }
    public function detailLaporan($id)
    {
        $laporan = Laporan::find($id);
        return view('ketua-bidang.detail.laporan', compact('laporan'));
    }
    public function verify(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);
        $validated = $request->validate([
            'status_verifikasi'   => ['required', Rule::in(['diterima', 'ditolak'])],
            'catatan_verifikasi'  => ['nullable', 'string', 'max:1000'],
        ]);

        DB::transaction(function () use ($laporan, $validated) {
            $laporan->status_verifikasi = $validated['status_verifikasi'];
            if ($validated['status_verifikasi'] === 'ditolak') {
                $laporan->status_penanganan = 'menunggu';
                $laporan->tanggal_selesai   = null;
            } elseif (! in_array($laporan->status_penanganan, ['menunggu', 'diproses', 'ditunda', 'selesai'], true)) {
                $laporan->status_penanganan = 'menunggu';
            }
            $laporan->save();
        });

        return back()->with(
            'success',
            $validated['status_verifikasi'] === 'diterima' ? 'Laporan berhasil diterima.' : 'Laporan berhasil ditolak.'
        );
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

    public function review(Request $request)
    {
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

        return view('ketua-bidang.review', compact('laporanTugas', 'stats'));
    }
    public function showReview(LaporanNonRutin $laporanTugas)
    {
        // Otorisasi per-bidang
        $laporanTugas->loadMissing([
            'timNonRutin:id,nama_tim,penanggung_jawab_id,bidang_id,deskripsi,created_at',
            'timNonRutin.penanggungJawab:id,name,email',
            'laporan:id,judul,kode_laporan,alamat,status_verifikasi,status_penanganan,tanggal_selesai,foto',
            'penanggungJawab:id,name,email',
        ]);

        abort_unless(
            $laporanTugas->timNonRutin && $laporanTugas->timNonRutin->bidang_id === Auth::user()->bidang_id,
            403
        );

        return view('ketua-bidang.detail.review', compact('laporanTugas'));
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

    public function storeAnggotaNonRutin(Request $request, $timId)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ], [
            'user_id.required' => 'Silahkan Pilih Pegawai yang ingin ditambahkan'
        ]);

        TimNonRutinUsers::create([
            'user_id' => $request->user_id,
            'tim_non_rutin_id' => $timId
        ]);

        return redirect()
            ->route('ketua.nonrutin.show', [$timId])
            ->with('success', 'Anggota berhasil ditambahkan');
    }
}
