<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use App\Models\DetailPeriksa;
use App\Models\Obat;
use App\Models\Periksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeriksaPasienController extends Controller
{
    public function index()
    {
        $id_dokter = Auth::user()->dokter->id;

        $data = DaftarPoli::with(['pasien', 'jadwalPeriksa.dokter', 'periksa'])
            ->whereHas('jadwalPeriksa', function ($query) use ($id_dokter) {
                $query->where('id_dokter', $id_dokter);
            })->get();

        return view('content.periksaPasien.index', compact('data'));
    }

    public function periksaPasienForm(Request $request, $id)
    {
        $obat = Obat::get();
        $daftarPoli = DaftarPoli::with('pasien')->findOrFail($id);

        return view('content.periksaPasien.periksa', compact('obat', 'daftarPoli'));
    }

    public function periksaPasien(Request $request, $id)
    {
        $validated = $request->validate([
            'tgl_periksa' => 'required|date',
            'catatan' => 'required|string|max:255',
            'biaya_periksa' => 'required|numeric|min:0',
            'obat' => 'required|array', 
            'obat.*' => 'exists:obats,id', 
        ]);

        $periksa = Periksa::create([
            'id_daftar_poli' => $id,
            'tgl_periksa' => $validated['tgl_periksa'],
            'catatan' => $validated['catatan'],
            'biaya_periksa' => $validated['biaya_periksa'],
        ]);

        foreach ($validated['obat'] as $idObat) {
            DetailPeriksa::create([
                'id_periksa' => $periksa->id,
                'id_obat' => $idObat,
            ]);
        }

        DaftarPoli::where('id', $id)->update(['status' => 'Sudah diperiksa']);

        return redirect()->route('index.periksapasien')->with('success', 'Pasien telah diperiksa, data berhasil disimpan.');
    }

    public function updatePeriksaForm(Request $request, $id)
    {
        $obat = Obat::all();

        $periksa = Periksa::with(['detailPeriksa.obat'])->where('id', $id)->firstOrFail();

        $selectedObatIds = $periksa->detailPeriksa->pluck('id_obat')->toArray();

        return view('content.periksaPasien.updatePeriksa', compact('obat', 'periksa', 'selectedObatIds'));
    }


    public function updatePeriksa(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'tgl_periksa' => 'required|date',
            'catatan' => 'required|string|max:255',
            'biaya_periksa' => 'required|numeric|min:0',
            'obat' => 'nullable|array', 
            'obat.*' => 'exists:obats,id', 
        ]);

        $data = [
            'tgl_periksa' => $validated['tgl_periksa'],
            'catatan' => $validated['catatan'],
            'biaya_periksa' => $validated['biaya_periksa'],
        ];

        $periksa = Periksa::findOrFail($id); 
        $periksa->update($data);

        if ($request->has('obat')) {
            $obatIds = $request->input('obat');
            $detailData = [];
            foreach ($obatIds as $obatId) {
                $detailData[] = [
                    'id_periksa' => $periksa->id,
                    'id_obat' => $obatId,
                ];
            }

            DetailPeriksa::where('id_periksa', $periksa->id)->delete();
            DetailPeriksa::insert($detailData);
        }

        return redirect()->route('index.periksapasien')->with('success', 'Data berhasil diupdate.');
    }

}
