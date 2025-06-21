<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Hitung jumlah mitra (usertype = 'mitra')
        $totalMitra = User::where('usertype', 'mitra')->count();

        // Hitung jumlah user (usertype = 'user')
        $totalUsers = User::where('usertype', 'user')->count();

        // Kirim data ke view
        return view('admin.dashboard', compact('totalMitra', 'totalUsers'));
    }
}
