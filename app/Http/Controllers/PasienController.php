<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasienController extends Controller
{
    public function registerPasienForm(){
        return view('auth.pasien.registerPasien');
    }

    public function registerPasien(Request $request)
    {
        $validatedPasien = $request->validate([
            'nama' => 'required|max:255',
            'alamat' => 'required|max:255',
            'no_hp' => 'required|max:15|regex:/^[0-9]+$/',
            'no_ktp' => 'required|string|unique:pasiens,no_ktp|regex:/^[0-9]+$/',
        ]);

        // tahun dan bulan sekarang
        $currentYear = now()->year;
        $currentMonth = now()->format('m');

        // jumlah pasien 
        $totalPatients = Pasien::count();

        // format: tahunbulan-urutan
        $noRm = sprintf('%s%s-%d', $currentYear, $currentMonth, $totalPatients + 1);

        $pasien = Pasien::create([
            'nama' => $validatedPasien['nama'],
            'alamat' => $validatedPasien['alamat'],
            'no_hp' => $validatedPasien['no_hp'],
            'no_ktp' => $validatedPasien['no_ktp'],
            'no_rm' => $noRm,
        ]);

        $user = User::create([
            'name' => $pasien->nama,
            'password' => Hash::make($pasien->no_hp),
            'role' => 'pasien', 
            'id_pasien' => $pasien->id, 
            'email' => $pasien->no_ktp . '@example.com',
        ]);

        return redirect()->route('login.pasien')->with('success', 'Registrasi berhasil!');
    }

    public function loginPasienForm()
    {
        return view('auth.pasien.loginPasien');
    }

    public function loginPasien(Request $request)
    {
        $validatePasien = $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        $data = [
            'name' => $validatePasien['name'],
            'password' => $validatePasien['password'],
        ];

        if(Auth::attempt($data)){
            return redirect()->route('dashboard');
        }else{
            return redirect()->route('login.pasien')->with('failed', 'Nama atau Password Salah!');
        }
    }

    public function logoutPasien(Request $request)
    {
        Auth::guard('web')->logout();

        // Hapus session pengguna
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.pasien')->with('success', 'Logout berhasil!');
    }

    public function index()
    {
        $data = Pasien::get();
        return view('content.pasien.index', compact('data'));
    }

    public function createPasienForm()
    {
        return view('content.pasien.createPasien');
    }

    public function createPasien(Request $request)
    {
        $dataValidated = $request->validate([
            'nama' => 'required|max:255',
            'alamat' => 'required|max:255',
            'no_hp' => 'required|max:15|regex:/^[0-9]+$/',
            'no_ktp' => 'required|string|unique:pasiens,no_ktp|regex:/^[0-9]+$/',
        ]);

        // tahun dan bulan sekarang
        $currentYear = now()->year;
        $currentMonth = now()->format('m');

        // jumlah pasien 
        $totalPatients = Pasien::count();

        // format: tahunbulan-urutan
        $noRm = sprintf('%s%s-%d', $currentYear, $currentMonth, $totalPatients + 1);

        $pasien = Pasien::create([
            'nama' => $dataValidated['nama'],
            'alamat' => $dataValidated['alamat'],
            'no_hp' => $dataValidated['no_hp'],
            'no_ktp' => $dataValidated['no_ktp'],
            'no_rm' => $noRm,
        ]);

        User::create([
            'name' => $pasien->nama,
            'password' => Hash::make($pasien->no_hp),
            'role' => 'pasien', 
            'id_pasien' => $pasien->id, 
            'email' => $pasien->no_ktp . '@example.com',
        ]);

        return redirect()->route('index.pasien')->with('success', 'Data berhasil ditambahkan');
    }

    public function updatePasien(Request $request, $id)
    {
        $dataValidated = $request->validate([
            'nama' => 'required|max:255',
            'alamat' => 'required|max:255',
            'no_hp' => 'required|max:15|regex:/^[0-9]+$/',
            'no_ktp' => 'required|string|regex:/^[0-9]+$/|unique:pasiens,no_ktp,' . $id,
        ]);

        $data = [
            'nama' => $dataValidated['nama'],
            'alamat' => $dataValidated['alamat'],
            'no_hp' => $dataValidated['no_hp'],
            'no_ktp' => $dataValidated['no_ktp'],
        ];

        Pasien::whereId($id)->update($data);

        return redirect()->route('index.pasien')->with('success', 'Data berhasil diupdate.');
    }

    public function deletePasien(Request $request, $id)
    {
        $pasien = Pasien::findOrFail($id);

        if($pasien){
            $pasien->delete();
            return redirect()->route('index.pasien')->with('success', 'Data berhasil dihapus.');
        }else {
            return redirect()->route('index.pasien')->with('error', 'Data gagal dihapus.');
        }
    }

    public function profilPasien()
    {
        $user = Auth::user();

        if ($user->role === 'pasien') {
            $pasien = $user->pasien;
        } else {
            $pasien = null;
        }
    
        return view('auth.pasien.profilPasien', compact('user', 'pasien'));
    }

    public function updateProfilPasien(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|max:15|regex:/^[0-9]+$/',
            'no_ktp' => 'required|string|regex:/^[0-9]+$/|unique:pasiens,no_ktp,' . $id,
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
            'no_ktp' => $request->no_ktp,
        ];

        if ($request->filled('password_baru')) {
            $user->password = Hash::make($request->password_baru);
        }

        $user->name = $request->nama;

        Pasien::whereId($id)->update($data);
        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
}
