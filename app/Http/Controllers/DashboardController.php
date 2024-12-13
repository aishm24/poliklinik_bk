<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role; // Ambil role pengguna yang login
        return view('content.dashboard', compact('role'));
    }
    
    
}
