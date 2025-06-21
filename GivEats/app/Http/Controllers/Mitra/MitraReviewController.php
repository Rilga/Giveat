<?php

namespace App\Http\Controllers\Mitra;

use App\Models\Donation;
use App\Models\Review;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MitraReviewController extends Controller
{
    public function index(){
         // Get statistics
         $stats = [
            'distributed' => Donation::where('status', 'completed')->count(),
            'recipients' => Donation::where('status', 'completed')->sum('portion'),
            'saved' => Donation::where('status', 'completed')->count() * 0.5, // Assuming 0.5kg per donation
        ];

        $reviews = Review::latest()->take(3)->get(); // ambil 3 review terbaru

        // Get recent orders
        $recentOrders = Donation::latest()
            ->take(5)
            ->get();

        return view('mitra.review.index', compact('stats', 'recentOrders', 'reviews'));
    }
}
