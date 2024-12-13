<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        $data = Obat::get();

        return view('content.obat.index', compact('data'));
    }

    public function createObatForm()
    {
        return view('content.obat.createObat');
    }

    public function createObat(Request $request)
    {
        $dataValidated = $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'required|string|max:100',
            'harga' => 'required|numeric',
        ]);

        Obat::create([
            'nama_obat' => $dataValidated['nama_obat'],
            'kemasan' => $dataValidated['kemasan'],
            'harga' => $dataValidated['harga'],
        ]);

        return redirect()->route('index.obat')->with('success', 'Data berhasil ditambahkan');
    }
    
    public function updateObat(Request $request, $id)
    {
        $dataValidated = $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'required|string|max:100',
            'harga' => 'required|numeric',
        ]);

        $data = [
            'nama_obat' => $dataValidated['nama_obat'],
            'kemasan' => $dataValidated['kemasan'],
            'harga' => $dataValidated['harga'],
        ];

        Obat::whereId($id)->update($data);

        return redirect()->route('index.obat')->with('success', 'Data berhasil diupdate.');
    }

    public function deleteObat(Request $request, $id)
    {
        $obat = Obat::findOrFail($id);

        if($obat){
            return redirect()->route('index.obat')->with('success', 'Data berhasil dihapus.');
        }else{
            return redirect()->route('index.obat')->with('error', 'Data gagal dihapus.');
        }
    }
}
