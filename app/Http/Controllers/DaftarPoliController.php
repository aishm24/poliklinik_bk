<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use App\Models\DetailPeriksa;
use App\Models\JadwalPeriksa;
use App\Models\Periksa;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DaftarPoliController extends Controller
{
    public function index()
    {
        $pasien = Auth::user()->pasien;
        $riwayat = DaftarPoli::with([
            'jadwalPeriksa.dokter.poli' 
        ])->where('id_pasien', $pasien->id) 
        ->get();

        return view('content.daftarPoli.index', compact('riwayat'));
    }

    public function getJadwal(Request $request)
    {
        $idPoli = $request->get('id_poli');

        if (!$idPoli) {
            return response()->json([
                'status' => 'error',
                'message' => 'Poli ID tidak ditemukan.'
            ], 400);
        }

        try {
            $jadwal = JadwalPeriksa::with('dokter')
                ->where('status', 1)
                ->whereHas('dokter', function ($query) use ($idPoli) {
                    $query->where('id_poli', $idPoli);
                })->get();

            if ($jadwal->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tidak ada jadwal yang tersedia untuk poli ini.'
                ]);
            }

            return response()->json([
                'status' => 'success',
                'data' => $jadwal->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'hari' => $item->hari,
                        'jam_mulai' => $item->jam_mulai,
                        'jam_selesai' => $item->jam_selesai,
                        'dokter' => $item->dokter->nama, // Include nama dokter
                    ];
                })
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat mengambil data jadwal: ' . $e->getMessage()
            ], 500);
        }
    }



    public function createDaftarPoliForm(){
        $poli = Poli::get();
        return view('content.daftarPoli.createDaftarPoli', compact('poli'));
    }

    public function createDaftarPoli(Request $request)
    {
        $validated = $request->validate([
            'id_poli' => 'required|exists:polis,id',
            'id_jadwal' => 'required|exists:jadwal_periksas,id',
            'keluhan' => 'required|string|max:255',
        ]);

        $pasien = Auth::user()->pasien;

        if (!$pasien) {
            return redirect()->back()->with('error', 'User tidak memiliki data pasien.');
        }

        $tanggalHariIni = now()->toDateString(); 
        $noAntrianHariIni = DaftarPoli::whereDate('created_at', $tanggalHariIni)->count() + 1;

        try {
            DaftarPoli::create([
                'id_pasien' => $pasien->id,
                'id_jadwal' => $validated['id_jadwal'],
                'keluhan' => $validated['keluhan'],
                'no_antrian' => $noAntrianHariIni,
            ]);

            return redirect()->route('index.daftarpoli')->with('success', 'Berhasil mendaftar ke poli.');
        } catch (\Exception $e) {
            return redirect()->route('index.daftarpoli')->with('error', 'Terjadi kesalahan saat mendaftar: ' . $e->getMessage());
        }
    }

    public function detailDaftarPoli(Request $request, $id)
    {
        $data = DaftarPoli::with([
            'jadwalPeriksa.dokter.poli' 
        ])->where('id', $id) 
        ->get();
        return view('content.daftarPoli.detailDaftarPoli', compact('data'));
    }


    public function riwayatDaftarPoli($id)
    {

        $data = DaftarPoli::with([
            'jadwalPeriksa.dokter.poli' 
        ])->where('id', $id) 
        ->get();

        // Ambil data pemeriksaan berdasarkan id daftar poli
        $riwayatPeriksa = Periksa::with([
            'detailPeriksa.obat' // Ambil data obat melalui relasi detailPeriksa
        ])->where('id_daftar_poli', $id)->get();

        if ($riwayatPeriksa->isEmpty()) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        // Siapkan data untuk view
        $dataRiwayat = [];
        foreach ($riwayatPeriksa as $periksa) {
            $listObat = [];

            foreach ($periksa->detailPeriksa as $detail) {
                $listObat[] = $detail->obat->nama_obat;
            }

            $dataRiwayat[] = [
                'tgl_periksa' => $periksa->tgl_periksa,
                'catatan' => $periksa->catatan,
                'obat' => $listObat,
                'biaya_periksa' => $periksa->biaya_periksa,
            ];
        }

        return view('content.daftarPoli.riwayatDaftarPoli', compact('dataRiwayat', 'data'));
    }

}
