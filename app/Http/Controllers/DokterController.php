<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Poli;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DokterController extends Controller
{

    public function registerDokterForm()
    {
        $data = Poli::get();

        return view('content.dokter.createDokter', compact('data'));
    }

    public function registerDokter(Request $request)
    {
        $dataValidated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:255',
            'poli' => 'required|exists:polis,id',
        ]);

        $dokter = Dokter::create([
            'id_poli' => $dataValidated['poli'],
            'nama' => $dataValidated['nama'],
            'alamat' => $dataValidated['alamat'],
            'no_hp' => $dataValidated['no_hp'],
        ]);

        $user = User::create([
            'name' => $dokter->nama,
            'password' => Hash::make($dokter->no_hp),
            'role' => 'dokter',
            'id_dokter' => $dokter->id,
            'email' => $dokter->nama. $dokter->no_hp . '@example.com',
        ]);

        return redirect()->route('index.dokter')->with('success', 'Data berhasil ditambahkan');
    }

    public function loginDokterForm()
    {
        return view('auth.dokter.loginDokter');
    }
    public function loginDokter(Request $request)
    {
        $validateDokter = $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        $data =  [
            'name' => $validateDokter['name'],
            'password' => $validateDokter['password'],
        ];

        if(Auth::attempt($data)){
            return redirect()->route('dashboard');
        }else {
            return redirect()->route('login.dokter')->with('failed', 'Nama atau Password Salah!');
        }
    }

    public function logoutDokter(Request $request)
    {
        Auth::guard('web')->logout();

        // Hapus session pengguna
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.dokter')->with('success', 'Logout berhasil!');
    }

    public function index()
    {
        $data = Dokter::with('poli')->get();
        $poli = Poli::get();

        return view('content.dokter.index', compact('data', 'poli'));
    }

    public function updateDokter(Request $request, $id)
    {
        $dataValidated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:255',
            'poli' => 'required|exists:polis,id',
        ]);

        $data = [
            'id_poli' => $dataValidated['poli'],
            'nama' => $dataValidated['nama'],
            'alamat' => $dataValidated['alamat'],
            'no_hp' => $dataValidated['no_hp'],
        ];

        Dokter::whereId($id)->update($data);

        return redirect()->route('index.dokter')->with('success', 'Data berhasil diupdate.');
    }

    public function deleteDokter(Request $request, $id)
    {
        $dokter = Dokter::findOrFail($id);

        if($dokter){
            $dokter->delete();
            return redirect()->route('index.dokter')->with('success', 'Data berhasil dihapus.');
        }else {
            return redirect()->route('index.dokter')->with('error', 'Data gagal dihapus.');
        }
    }

    public function profilDokter()
    {
        $user = Auth::user();

        if ($user->role === 'dokter') {
            // Ambil data dokter berdasarkan user yang login
            $dokter = $user->dokter;
        } else {
            $dokter = null;
        }
    
        return view('auth.dokter.profilDokter', compact('user', 'dokter'));
    }

    public function updateProfilDokter(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:255',
            'password_lama' => 'required|string|min:8',
            'password_baru' => 'nullable|string|min:8',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password_lama, $user->password)) {
            return redirect()->back()->with('error', 'Update Gagal! Password yang Anda masukkan salah.');
        }

        $data = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ];

        if ($request->filled('password_baru')) {
            $user->password = Hash::make($request->password_baru);
        }

        $user->name = $request->nama;

        Dokter::whereId($id)->update($data);
        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }


}
