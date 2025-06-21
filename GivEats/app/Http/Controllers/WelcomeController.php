<?php

namespace App\Http\Controllers;

use App\Models\User; // Pastikan model User di-import
use App\Models\Claim; // Asumsikan ada model Claim untuk menghitung total klaim
use Illuminate\Http\Request;

class WelcomeController extends Controller // Ganti dengan nama controller Anda
{
    public function index() // Ganti dengan nama method Anda
    {
        // Hitung jumlah mitra (users dengan usertype = 'mitra')
        $totalMitra = User::where('usertype', 'mitra')->count();

        // Hitung jumlah user (users dengan usertype = 'user')
        $totalUsers = User::where('usertype', 'user')->count();

        // Hitung total klaim (Anda mungkin perlu menyesuaikan query ini)
        // Contoh: Menghitung total baris di tabel 'claims'
       
        // Atau contoh: Menghitung total porsi dari donasi yang diklaim/selesai
        // $totalKlaim = \App\Models\Donation::where('status', 'claimed')->orWhere('status', 'completed')->sum('portion');


        // Kirim data ke view
        return view('welcome', compact('totalMitra', 'totalUsers', 'totalKlaim'));
    }
}