<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CatatanController extends Controller
{
    public function index() {
        // Mendapatkan total pemasukan
        $totalPemasukan = Pemasukan::where('id_users', Auth::id())->sum('jumlah');

        // Mendapatkan total pengeluaran
        $totalPengeluaran = Pengeluaran::where('id_users', Auth::id())->sum('jumlah');

        // Mendapatkan data pemasukan
        $pemasukan = Pemasukan::where('id_users', Auth::id())->get();

        // Mendapatkan data pengeluaran
        $pengeluaran = Pengeluaran::where('id_users', Auth::id())->get();

        // Hitung total saldo
        $totalSaldo = $totalPemasukan - $totalPengeluaran;

        // Kirim data ke view
        return view('catatan', compact('totalSaldo', 'pemasukan', 'pengeluaran'));
    }
}
