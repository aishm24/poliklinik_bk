<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use App\Models\Pasien;
use App\Models\Periksa;
use Illuminate\Http\Request;

class RiwayatPasienController extends Controller
{
    
    public function index(){
        $data = Pasien::get();
        
        return view('content.riwayatPasien.index', compact('data'));
    }

    public function detailRiwayatPasien($id)
    {
        // Cari pasien berdasarkan ID
        $pasien = Pasien::findOrFail($id);

        // Ambil semua riwayat pemeriksaan pasien melalui DaftarPoli
        $riwayatPeriksa = Periksa::with([
            'detailPeriksa.obat',        // Ambil data obat melalui relasi detailPeriksa
            'daftarPoli.jadwalPeriksa.dokter',        // Ambil data dokter melalui relasi daftarPoli
            'daftarPoli.pasien'         // Pastikan pasien sesuai dengan id
        ])->whereHas('daftarPoli', function ($query) use ($id) {
            $query->where('id_pasien', $id); // Filter berdasarkan pasien
        })->get();

        // if ($riwayatPeriksa->isEmpty()) {
        //     return response()->json(['message' => 'Data tidak ditemukan'], 404);
        // }

        // Siapkan data untuk view
        $dataRiwayat = [];
        foreach ($riwayatPeriksa as $periksa) {
            $listObat = [];
            foreach ($periksa->detailPeriksa as $detail) {
                $listObat[] = $detail->obat->nama_obat;
            }

            $dataRiwayat[] = [
                'tgl_periksa' => $periksa->tgl_periksa,
                'nama_dokter' => $periksa->daftarPoli->jadwalPeriksa->dokter->nama ?? '-', // Nama dokter dari relasi
                'keluhan' => $periksa->daftarPoli->keluhan ?? '-',          // Keluhan pasien
                'catatan' => $periksa->catatan ?? '-',                      // Catatan pemeriksaan
                'obat' => $listObat,                                        // Daftar obat
                'biaya_periksa' => $periksa->biaya_periksa,                 // Biaya pemeriksaan
            ];
        }

        // Return ke view dengan data pasien dan riwayat
        return view('content.riwayatPasien.detailRiwayatPasien', compact('dataRiwayat', 'pasien'));
    }

}
