<?php

namespace App\Http\Controllers;

use App\Models\Sampah;
use App\Models\SetorSampah;
use App\Models\User;
use Illuminate\Http\Request;

class SetorSampahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setor = SetorSampah::with([
            'nasabah.profile',
            'petugas.profile',
            'sampah'
        ])
        ->get();

        return view('setor.index', compact('setor'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $nasabah = User::with('profile')
            ->where('role', 'nasabah')
            ->where('is_active', true)
            ->get();

        $sampah = Sampah::where('is_active', true)->get();

        return view('setor.create', compact('nasabah', 'sampah'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nasabah_id' => 'required|exists:users,id',
            'tanggal' => 'required|date',
            'sampah_id.*' => 'required|exists:sampah,id',
            'berat.*' => 'required|numeric|min:0.01',
        ],[
            'nasabah_id.required' => 'nasabah harus diisi.',
            'tanggal.required' => 'tanggal setor harus diisi.',
            'sampah_id.*.required' => 'sampah harus diisi.',
            'berat.*.required' => 'berat harus diisi'
        ]);

        foreach ($request->sampah_id as $index => $sampahId) {
            SetorSampah::create([
                'nasabah_id' => $request->nasabah_id,
                'petugas_id' => auth()->id(),
                'sampah_id' => $sampahId,
                'berat' => $request->berat[$index],
                'tanggal_transaksi' => $request->tanggal,
                'total_poin' => 0,
            ]);
        }

        return redirect()->route('setor.index')
            ->with('success', 'Setor sampah berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
