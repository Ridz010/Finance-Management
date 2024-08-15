<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $totalPemasukan = Pemasukan::where('id_users', $userId)->sum('jumlah');
        $totalPengeluaran = Pengeluaran::where('id_users', $userId)->sum('jumlah');
        $totalSaldo = $totalPemasukan - $totalPengeluaran;

        // Data pemasukan dan pengeluaran per bulan
        $monthlyPemasukan = Pemasukan::selectRaw('SUM(jumlah) as total, MONTH(tanggal) as bulan')
            ->where('id_users', $userId)
            ->groupBy('bulan')
            ->get()
            ->pluck('total', 'bulan')
            ->toArray();

        $monthlyPengeluaran = Pengeluaran::selectRaw('SUM(jumlah) as total, MONTH(tanggal) as bulan')
            ->where('id_users', $userId)
            ->groupBy('bulan')
            ->get()
            ->pluck('total', 'bulan')
            ->toArray();

        // Kirim data ke view
        return view('dashboard', compact('totalSaldo', 'monthlyPemasukan', 'monthlyPengeluaran'));
    }
}
