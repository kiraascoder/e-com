<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\LaporanNonRutin;
use App\Models\TimNonRutin;
use App\Models\TimRutin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PegawaiController extends Controller
{
    public function index()
    {
        return view('pegawai.index');
    }

    public function tim()
    {
        $user = Auth::user();
        $timRutin = TimRutin::whereHas('anggota', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })
            ->orWhere('penanggung_jawab_id', $user->id)
            ->with(['penanggungJawab', 'anggota'])
            ->get();

        $timNonRutin = TimNonRutin::whereHas('anggota', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })
            ->orWhere('penanggung_jawab_id', $user->id)
            ->with(['penanggungJawab', 'anggota'])
            ->get();

        return view('pegawai.tim', compact('timRutin', 'timNonRutin'));
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
        return view('pegawai.detail.tim-rutin', compact('timRutin', 'users', 'anggotaTim', 'timRutinAnggota'));
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
        return view('pegawai.detail.tim-nonrutin', compact('timNonRutin', 'users', 'anggotaTim', 'timNonRutinAnggota'));
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
        return view('pegawai.laporan', compact('laporans', 'stats'));
    }
    public function detailLaporan($id)
    {
        $laporan = Laporan::find($id);
        return view('pegawai.detail.laporan', compact('laporan'));
    }
    public function updateStatus(Request $request, TimNonRutin $timNonRutin)
    {
        // Otorisasi: hanya PJ tim ini
        if (Auth::id() !== ($timNonRutin->penanggung_jawab_id ?? null)) {
            abort(403, 'Anda tidak berwenang memperbarui status tim ini.');
        }

        $validated = $request->validate([
            'status_penanganan' => ['required', Rule::in(['diproses', 'selesai'])],
        ], [], [
            'status_penanganan' => 'status penanganan',
        ]);


        $laporan = $timNonRutin->laporan()->firstOrFail();


        if ($laporan->status_verifikasi !== 'diterima') {
            return back()->with('success', 'Laporan belum diterima, status penanganan tidak dapat diperbarui.');
        }


        $laporan->status_penanganan = $validated['status_penanganan'];
        if ($validated['status_penanganan'] === 'selesai') {
            $laporan->tanggal_selesai = now();
        }
        $laporan->save();

        return back()->with('success', 'Status penanganan berhasil diperbarui.');
    }
    public function task()
    {

        $teams = TimNonRutin::with([
            'penanggungJawab:id,name',
            'laporan:id,judul,kode_laporan,status_verifikasi,status_penanganan,tanggal_selesai',
            'laporanNonRutin:id,laporan_id,tim_non_rutin_id'
        ])
            ->where('penanggung_jawab_id', auth()->id())
            ->where('bidang_id', auth()->user()->bidang_id)
            ->latest()
            ->get();

        return view('pegawai.task', [
            'timNonRutins' => $teams,
        ]);
    }

    public function taskSubmit(TimNonRutin $timNonRutin)
    {
        abort_if($timNonRutin->bidang_id !== Auth::user()->bidang_id, 403);
        abort_if(Auth::id() !== ($timNonRutin->penanggung_jawab_id ?? null), 403);

        $timNonRutin->load([
            'penanggungJawab:id,name',
            'laporan:id,judul,kode_laporan,alamat,status_verifikasi,status_penanganan,tanggal_selesai',
        ]);
        $laporan = $timNonRutin->laporan;
        if (! $laporan) {
            return redirect()->back()->with('error', 'Tim ini belum terhubung dengan laporan warga.');
        }
        if (!($laporan->status_verifikasi === 'diterima' && $laporan->status_penanganan === 'selesai')) {
            return redirect()->back()->with('error', 'Laporan warga belum DITERIMA & SELESAI.');
        }
        if (LaporanNonRutin::where('laporan_id', $laporan->id)->exists()) {
            return redirect()->back()->with('error', 'Laporan tugas untuk laporan ini sudah dibuat.');
        }
        return view('pegawai.task-form', [
            'timNonRutin' => $timNonRutin,
            'laporan'     => $laporan,
        ]);
    }
    public function storeTask(Request $request, TimNonRutin $timNonRutin)
    {
        abort_if($timNonRutin->bidang_id !== Auth::user()->bidang_id, 403);
        abort_if(Auth::id() !== ($timNonRutin->penanggung_jawab_id ?? null), 403);
        $laporan = $timNonRutin->laporan()->firstOrFail();
        if (!($laporan->status_verifikasi === 'diterima' && $laporan->status_penanganan === 'selesai')) {
            return back()
                ->withErrors(['laporan' => 'Laporan warga belum DITERIMA & SELESAI.'])
                ->withInput();
        }
        $validated = $request->validate([
            'tanggal'          => ['required', 'date', 'before_or_equal:today'],
            'deskripsi'        => ['required', 'string'],
            'anggaran'         => ['nullable', 'numeric', 'min:0'],
            'sumber_anggaran'  => ['nullable', 'string', 'max:255'],
            'catatan_anggaran' => ['nullable', 'string'],
        ], [], [
            'tanggal'   => 'tanggal',
            'deskripsi' => 'deskripsi',
        ]);

        if (LaporanNonRutin::where('laporan_id', $laporan->id)->exists()) {
            return back()->withErrors(['laporan' => 'Laporan tugas untuk laporan ini sudah dibuat.'])->withInput();
        }
        DB::transaction(function () use ($timNonRutin, $laporan, $validated) {
            LaporanNonRutin::create([
                'tim_non_rutin_id'    => $timNonRutin->id,
                'laporan_id'          => $laporan->id,
                'penanggung_jawab_id' => $timNonRutin->penanggung_jawab_id, // set otomatis (PJ)
                'tanggal'             => $validated['tanggal'],
                'deskripsi'           => $validated['deskripsi'],
                'anggaran'            => $validated['anggaran'] ?? null,
                'sumber_anggaran'     => $validated['sumber_anggaran'] ?? null,
                'catatan_anggaran'    => $validated['catatan_anggaran'] ?? null,
            ]);
        });
        return redirect()
            ->route('pegawai.task', $timNonRutin)
            ->with('success', 'Laporan tugas berhasil disimpan.');
    }
}
