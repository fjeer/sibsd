<?php

namespace App\Http\Controllers;

use App\Models\SetorSampah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $nasabah = User::where('role','nasabah')->where('is_active',true)->count();
        $petugas = User::where('role','petugas')->where('is_active',true)->count();
        $transaksi = SetorSampah::count();

        $grafik = SetorSampah::select(
            DB::raw('MONTH(tanggal_transaksi) as bulan'),
            DB::raw('SUM(berat) as total_berat')
        )
            ->whereYear('tanggal_transaksi', date('Y'))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Siapkan array untuk Chart.js
        $labels = [];
        $data = [];

        foreach ($grafik as $row) {
            $labels[] = date('F', mktime(0, 0, 0, $row->bulan, 1)); // Januari, Februari, dst
            $data[] = $row->total_berat;
        }

        return view('dashboard.index', compact('nasabah','petugas','transaksi','labels','data')); 
    }
}
