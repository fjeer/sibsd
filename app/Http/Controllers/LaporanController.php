<?php

namespace App\Http\Controllers;

use App\Models\Sampah;
use App\Models\SetorSampah;
use App\Models\User;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request) 
    {
         $query = SetorSampah::with(['nasabah.profile', 'sampah']);

        // Filter nasabah
        if ($request->filled('id_nasabah')) {
            $query->where('nasabah_id', $request->id_nasabah);
        }

        // Filter jenis sampah
        if ($request->filled('id_sampah')) {
            $query->where('sampah_id', $request->id_sampah);
        }

        // Filter tanggal
        if ($request->filled('dari') && $request->filled('sampai')) {
            $query->whereBetween('tanggal_transaksi', [
                $request->dari,
                $request->sampai
            ]);
        }

        $setoran = $query->orderBy('tanggal_transaksi', 'desc')->get();

        // Data dropdown
        $nasabahs = User::where('role', 'nasabah')->where('is_active', true)->get();
        $sampahs  = Sampah::where('is_active', true)->get();

        // Total
        $totalBerat = $setoran->sum('berat');
        $totalPoin  = $setoran->sum('total_poin');

        return view('laporan.index', compact(
            'setoran',
            'nasabahs',
            'sampahs',
            'totalBerat',
            'totalPoin'
        ));
    }
}
