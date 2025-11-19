<?php

namespace App\Http\Controllers;

use App\Models\Saran;
use Illuminate\Http\Request;

class SaranController extends Controller
{
    public function index()
    {
        return view('saran.index');
    }
    public function storeSaran(Request $request)
    {
        $validated = $request->validate([
            'nama'      => ['nullable', 'string', 'max:255'],
            'kontak'    => ['nullable', 'string', 'max:255'],
            'kategori'  => ['nullable', 'in:pelayanan,infrastruktur,sistem,lainnya'],
            'judul'     => ['required', 'string', 'max:255'],
            'isi_saran' => ['required', 'string'],
            'kepuasan'  => ['nullable', 'integer', 'between:1,5'],
            'follow_up' => ['nullable', 'boolean'],
        ]);

     
        $validated['user_id'] = auth()->id();    
        $validated['follow_up'] = $request->boolean('follow_up');
        $validated['status_tindak_lanjut'] = 'baru';

        Saran::create($validated);

        return redirect()
            ->back()
            ->with('success', 'Terima kasih, saran Anda telah terkirim.');
    }
}
