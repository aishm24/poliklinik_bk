<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\JadwalPeriksa;
use App\Models\Konsultasi;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KonsultasiController extends Controller
{
    public function indexPasien()
    {
        $pasien = Auth::user()->pasien;
        $data = Konsultasi::where('id_pasien', $pasien->id)->get();

        return view('content.konsultasiPasien.index', compact('data'));
    }

    public function createKonsultasiPasienForm()
    {
        $dokter = Dokter::get();
        return view('content.konsultasiPasien.createKonsultasiPasien', compact('dokter'));
    }

    public function createKonsultasiPasien(Request $request)
    {
        $validated = $request->validate([
            'id_dokter' => 'required|exists:dokters,id',
            'subject' => 'required|max:100',
            'pertanyaan' => 'required|max:255',
            'tgl_konsultasi' => 'required|date',
        ]);

        $pasien = Auth::user()->pasien;

        if (!$pasien) {
            return redirect()->back()->with('error', 'User tidak memiliki data pasien.');
        }

        try {
            Konsultasi::create([
                'id_pasien' => $pasien->id,
                'id_dokter' => $validated['id_dokter'],
                'subject' => $validated['subject'],
                'pertanyaan' => $validated['pertanyaan'],
                'tgl_konsultasi' => $validated['tgl_konsultasi'],
            ]);

            return redirect()->route('index.konsultasi.pasien')->with('success', 'Berhasil Mengirim Konsultasi');
        } catch (\Exception $e) {
            return redirect()->route('index.konsultasi.pasien')->with('error', 'Terjadi kesalahan saat Konsultasi: ' . $e->getMessage());
        }
    }

    public function updateKonsultasi(Request $request, $id)
    {
        $dataValidated = $request->validate([
            'subject' => 'required|max:100',
        ]);

        $data = [
            'subject' => $dataValidated['subject'],
        ];

        Konsultasi::whereId($id)->update($data);

        return redirect()->route('index.konsultasi.pasien')->with('success', 'Data berhasil diupdate.');
    }

    public function deleteKonsultasi(Request $request, $id)
    {
        $konsultasi = Konsultasi::findOrFail($id);

        if ($konsultasi) {
            $konsultasi->delete();
            return redirect()->route('index.konsultasi.pasien')->with('success', 'Data berhasil dihapus.');
        } else {
            return redirect()->route('index.konsultasi.pasien')->with('error', 'Data gagal dihapus.');
        }
    }

    public function indexDokter()
    {
        $dokter = Auth::user()->dokter;
        $data = Konsultasi::where('id_dokter', $dokter->id)->get();

        return view('content.konsultasiDokter.index', compact('data'));
    }

    public function tanggapanDokter(Request $request, $id)
    {
        $dataValidated = $request->validate([
            'tanggapan' => 'required|max:255',
        ]);

        $data = [
            'jawaban' => $dataValidated['tanggapan'],
        ];

        Konsultasi::whereId($id)->update($data);

        return redirect()->route('index.konsultasi.dokter')->with('success', 'Pasien telah diberi tanggapan');
    }
}
