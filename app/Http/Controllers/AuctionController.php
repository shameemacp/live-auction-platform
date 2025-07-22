<?php

namespace App\Http\Controllers;
use App\Models\Product;

use Illuminate\Http\Request;

class AuctionController extends Controller
{
    public function index()
{
    // Only show live products
    $products = Product::where('end_time', '>', now())->get();
    return view('auction.index', compact('products'));
}

public function show(Product $product)
{
    return view('auction.show', compact('product'));
}
}
