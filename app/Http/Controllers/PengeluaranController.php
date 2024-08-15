<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengeluaranController extends Controller
{
    public function getTotalPengeluaran()
    {
        $totalPengeluaran = Pengeluaran::where('id_users', Auth::id())->sum('jumlah');
        return $totalPengeluaran;
    }

    public function index()
    {
        $pengeluaran = Pengeluaran::where('id_users', Auth::id())->get();
        $jenisPengeluaranOptions = ['Pengeluaran Harian', 'Pengeluaran Bulanan', 'Pengeluaran Tahunan'];
        $keperluanOptions = ['Makanan', 'Transportasi', 'Hiburan', 'Tagihan', 'Kesehatan', 'Lainnya'];

        return view('pengeluaran', [
            'pengeluaran' => $pengeluaran,
            'jenisPengeluaranOptions' => $jenisPengeluaranOptions,
            'keperluanOptions' => $keperluanOptions
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jenis_pengeluaran' => 'required',
            'keterangan' => 'required|max:50',
            'keperluan' => 'required|max:30',
            'jumlah' => 'required|numeric',
        ]);

        $pengeluaran = new Pengeluaran();
        $pengeluaran->tanggal = $request->tanggal;
        $pengeluaran->jenis_pengeluaran = $request->jenis_pengeluaran;
        $pengeluaran->keterangan = $request->keterangan;
        $pengeluaran->keperluan = $request->keperluan;
        $pengeluaran->jumlah = $request->jumlah;
        $pengeluaran->id_users = auth()->id();
        $pengeluaran->save();

        return redirect()->route('pengeluaran')->with('success', 'Data pengeluaran berhasil disimpan.');
    }

    public function edit($id) {
        $pengeluaran = Pengeluaran::find($id);
        $jenisPengeluaranOptions = ['Pengeluaran Harian', 'Pengeluaran Bulanan', 'Pengeluaran Tahunan'];
        $keperluanOptions = ['Makanan', 'Transportasi', 'Hiburan', 'Tagihan', 'Kesehatan', 'Lainnya'];

        return view('pengeluaran_edit', [
            'pengeluaran' => $pengeluaran,
            'jenisPengeluaranOptions' => $jenisPengeluaranOptions,
            'keperluanOptions' => $keperluanOptions
        ]);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'tanggal' => 'required|date',
            'jenis_pengeluaran' => 'required',
            'keterangan' => 'required|max:50',
            'keperluan' => 'required|max:30',
            'jumlah' => 'required|numeric',
        ]);

        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->tanggal = $request->tanggal;
        $pengeluaran->jenis_pengeluaran = $request->jenis_pengeluaran;
        $pengeluaran->keterangan = $request->keterangan;
        $pengeluaran->keperluan = $request->keperluan;
        $pengeluaran->jumlah = $request->jumlah;
        $pengeluaran->save();

        return redirect()->route('pengeluaran')->with('success', 'Data pengeluaran berhasil diperbarui.');
    }

    public function destroy($id) {
        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->delete();

        return redirect()->route('pengeluaran')->with('success', 'Data pengeluaran berhasil dihapus.');
    }
}
