<?php

namespace App\Http\Controllers;

use App\Models\JadwalPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalPeriksaController extends Controller
{
    public function index()
    {
        $dokter = Auth::user()->dokter;

        if (!$dokter) {
            return redirect()->back()->with('error', 'Dokter tidak ditemukan.');
        }

        $data = JadwalPeriksa::with('dokter')
            ->where('id_dokter', $dokter->id) // Filter berdasarkan ID dokter
            ->get();

        return view('content.jadwalPeriksa.index', compact('data'));
    }


    public function createJadwalPeriksaForm()
    {
        return view('content.jadwalPeriksa.createJadwalPeriksa');
    }

    public function createJadwalPeriksa(Request $request)
    {
        $dataValidated = $request->validate([
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        $dokter = Auth::user()->dokter;

        $validasiHari = JadwalPeriksa::where('id_dokter', $dokter->id)
        ->where('hari', $request->hari)
        ->exists();

        if($validasiHari){
            return redirect()->route('create.jadwalperiksa')->with('error', 'Silahkan ganti hari, Karena sudah memiliki jadwal praktek pada hari tersebut.');
        }

        JadwalPeriksa::create([
            'id_dokter' => $dokter->id,
            'hari' => $dataValidated['hari'],
            'jam_mulai' => $dataValidated['jam_mulai'],
            'jam_selesai' => $dataValidated['jam_selesai'],
        ]);

        return redirect()->route('index.jadwalperiksa')->with('success', 'Data berhasil ditambahkan');
    }

    public function updateJadwalPeriksa(Request $request, $id)
    {
        $requestValidated = $request->validate([
            'status' => 'required|boolean',
        ]);

        $jadwal = JadwalPeriksa::findOrFail($id); 

        if ($requestValidated['status'] == 1) {
            // Nonaktifkan status = 1 pada dokter yang sama
            $updatedRows = JadwalPeriksa::where('id_dokter', $jadwal->id_dokter)
                ->where('status', 1)
                ->update(['status' => 0]);
        }

        $jadwal->update(['status' => $requestValidated['status']]);

        return redirect()->route('index.jadwalperiksa')->with('success', 'Status berhasil diupdate.');
    }


}
