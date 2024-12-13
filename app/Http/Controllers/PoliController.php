<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    public function index()
    {
        $data = Poli::get();

        return view('content.poli.index', compact('data'));
    }

    public function createPoliForm()
    {
        return view('content.poli.createPoli');
    }

    public function createPoli(Request $request)
    {
        $dataValidated = $request->validate([
            'nama_poli' => 'required|max:25',
            'keterangan' => 'required|max:255',
        ]);

        Poli::create([
            'nama_poli' => $dataValidated['nama_poli'],
            'keterangan' => $dataValidated['keterangan'],
        ]);

        return redirect()->route('index.poli')->with('success', 'Data berhasil ditambahkan.');
    }

    public function updatePoli(Request $request, $id)
    {
        $dataValidated = $request->validate([
            'nama_poli' => 'required|max:25',
            'keterangan' => 'required|max:255',
        ]);

        $data = [
            'nama_poli' => $dataValidated['nama_poli'],
            'keterangan' => $dataValidated['keterangan'],
        ];

        try {
            Poli::whereId($id)->update($data);
    
            // $poli = Poli::findOrFail($id);
            // $poli->update($dataValidated);
    
            return redirect()->route('index.poli')->with('success', 'Data berhasil diupdate');
            
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error_id', $id);
        }
    }

    public function deletePoli(Request $request, $id)
    {
        $poli = Poli::findOrFail($id);
        if($poli){
            $poli->delete();
            return redirect()->route('index.poli')->with('success', 'Data berhasil dihapus.');
        } else {
            return redirect()->route('index.poli')->with('error', 'Data gagal dihapus.');
        }
    }

}
