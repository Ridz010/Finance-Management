<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemasukanController extends Controller
{
    public function getTotalPemasukan()
    {
        $totalPemasukan = Pemasukan::where('id_users', Auth::id())->sum('jumlah');
        return $totalPemasukan;
    }

    public function index()
    {
        $pemasukan = Pemasukan::where('id_users', Auth::id())->get();
        $jenisPemasukanOptions = ['Pemasukan Harian', 'Pemasukan Bulanan', 'Pemasukan Tahunan'];
        $sumberPemasukanOptions = ['Gaji', 'Investasi', 'Bisnis', 'Hadiah', 'Lainnya'];

        return view('pemasukan', [
            'pemasukan' => $pemasukan,
            'jenisPemasukanOptions' => $jenisPemasukanOptions,
            'sumberPemasukanOptions' => $sumberPemasukanOptions
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jenis_pemasukan' => 'required',
            'keterangan' => 'required|max:50',
            'sumber' => 'required',
            'jumlah' => 'required|numeric',
        ]);

        $pemasukan = new Pemasukan();
        $pemasukan->tanggal = $request->tanggal;
        $pemasukan->jenis_pemasukan = $request->jenis_pemasukan;
        $pemasukan->keterangan = $request->keterangan;
        $pemasukan->sumber = $request->sumber;
        $pemasukan->jumlah = $request->jumlah;
        $pemasukan->id_users = auth()->id();
        $pemasukan->save();

        return redirect()->route('pemasukan')->with('success', 'Data pemasukan berhasil disimpan.');
    }

    public function edit($id)
    {
        $pemasukan = Pemasukan::find($id);
        $jenisPemasukanOptions = ['Pemasukan Harian', 'Pemasukan Bulanan', 'Pemasukan Tahunan'];
        $sumberPemasukanOptions = ['Gaji', 'Investasi', 'Bisnis', 'Hadiah', 'Lainnya'];

        return view('pemasukan_edit', [
            'pemasukan' => $pemasukan,
            'jenisPemasukanOptions' => $jenisPemasukanOptions,
            'sumberPemasukanOptions' => $sumberPemasukanOptions
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jenis_pemasukan' => 'required',
            'keterangan' => 'required|max:50',
            'sumber' => 'required',
            'jumlah' => 'required|numeric',
        ]);

        $pemasukan = Pemasukan::findOrFail($id);
        $pemasukan->tanggal = $request->tanggal;
        $pemasukan->jenis_pemasukan = $request->jenis_pemasukan;
        $pemasukan->keterangan = $request->keterangan;
        $pemasukan->sumber = $request->sumber;
        $pemasukan->jumlah = $request->jumlah;
        $pemasukan->save();

        return redirect()->route('pemasukan')->with('success', 'Data pemasukan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pemasukan = Pemasukan::findOrFail($id);
        $pemasukan->delete();
        return redirect()->route('pemasukan')->with('success', 'Data pemasukan berhasil dihapus.');
    }
}
