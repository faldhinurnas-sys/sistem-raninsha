<?php

namespace App\Http\Controllers;

use App\Models\Product;

class LandingController extends Controller
{
    public function index()
    {
        // hanya produk aktif yang ditampilkan ke user
        $products = Product::where('is_active', true)
            ->latest()
            ->get();

        return view('landing', compact('products'));
    }
}
