<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function registerAdminForm()
    {
        return view('auth.admin.registerAdmin');
    }

    public function registerAdmin(Request $request)
    {
        $validateAdmin = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email|max:255|email',
            'password' => 'required|min:8'
        ]);

        $user = User::create([
            'name' => $validateAdmin['name'],
            'email' => $validateAdmin['email'],
            'role' => 'admin',
            'password' => Hash::make($validateAdmin['password']),
        ]);

        if($user){
            return redirect()->route('login.admin')->with('success', 'Register Admin Berhasil!');
        }else{
            return redirect()->route('login.admin')->with('errors', 'Register Admin Gagal!');
        }
    }

    public function createAdminForm()
    {
        return view('content.admin.createAdmin');
    }

    public function createAdmin(Request $request)
    {
        $validateAdmin = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email|max:255|email',
            'password' => 'required|min:8'
        ]);

        $user = User::create([
            'name' => $validateAdmin['name'],
            'email' => $validateAdmin['email'],
            'role' => 'admin',
            'password' => Hash::make($validateAdmin['password']),
        ]);

        if($user){
            return redirect()->route('index.admin')->with('success', 'Register Admin Berhasil!');
        }else{
            return redirect()->route('index.admin')->with('errors', 'Register Admin Gagal!');
        }
    }

    public function loginAdminForm(){
        return view('auth.admin.loginAdmin');
    }

    public function loginAdmin(Request $request)
    {
        $validateAdmin = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required',
        ]);

        $data = [
            'email' => $validateAdmin['email'],
            'password' => $validateAdmin['password'],
        ];

        if(Auth::attempt($data)){
            return redirect()->route('dashboard');
        }else {
            return redirect()->route('login.admin')->with('failed', 'Email atau Password Salah!');
        }
    }

    public function logoutAdmin(Request $request)
    {
        Auth::guard('web')->logout();

        // Hapus session pengguna
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.admin')->with('success', 'Logout berhasil!');
    }

    public function profilAdmin()
    {
        return view('auth.admin.profilAdmin');
    }

    public function updateProfilAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password_lama' => 'required|string|min:8',
            'password_baru' => 'nullable|string|min:8',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password_lama, $user->password)) {
            return redirect()->back()->with('error', 'Update Gagal! Password yang Anda masukkan salah.');
        }

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password_baru')) {
            $user->password = Hash::make($request->password_baru);
        }

        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function getAllAdmin()
    {
        $data = User::where('role', 'admin')->get();

        if ($data->isEmpty()) {
            return redirect()->route('index.admin')->with('error', 'Tidak ada admin yang ditemukan.');
        }

        return view('content.admin.index', compact('data'));
    }

    public function deleteAdmin(Request $request, $id)
    {
        $user = User::find($id);

        if($user){
            $user->delete();
            return redirect()->route('index.admin')->with('success', 'Data berhasil dihapus.');
        }else {
            return redirect()->route('index.admin')->with('error', 'Data gagal dihapus.');
        }
    }


}
