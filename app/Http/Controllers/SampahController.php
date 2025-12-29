<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sampah;

class SampahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Sampah::query();
        
        if ($request->search) {
            $query = $query->where(function($q) use ($request) {
                $q->where('jenis_sampah', 'like', "%{$request->search}%")
                    ->orWhere('harga_per_kg', 'like', "%{$request->search}%")
                    ->orWhere('deskripsi', 'like', "%{$request->search}%");
            });
        }

        if ($request->trashed && auth()->user()->role === 'admin') 
        {
            if ($request->trashed === 'only') {
                $query->onlyTrashed();
            } elseif ($request->trashed === 'with') {
                $query->withTrashed();
            } else {
                $query->withoutTrashed();
            }
        }

        $sampah = $query->latest()->get();

        return view('sampah.index', compact('sampah'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sampah.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'jenis_sampah' => 'required|string',
            'harga_per_kg' => 'required|numeric',
            'deskripsi' => 'nullable|string'
        ]);

        Sampah::create($validate);

        return redirect()->route('sampah.index')->with('succes', 'Sampah berhasil ditambahkan.');
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
        $sampah = Sampah::findOrFail($id);

        return view('sampah.edit', compact('sampah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'jenis_sampah' => 'required|string',
            'harga_per_kg' => 'required|numeric',
            'deskripsi' => 'nullable|string'
        ]);

        $sampah = Sampah::findOrFail($id);
        $sampah->update($validate);

        return redirect()->route('sampah.index')->with('success','Sampah berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sampah = Sampah::findOrFail($id);
        $sampah->update(['is_active' => false]);
        $sampah->save();

        $sampah->delete();

        return redirect()->route('sampah.index')->with('success','Sampah berhasil dihapus.');
    }
}
