<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Message; 

use Illuminate\Http\Request;

class BidPageController extends Controller
{
     public function show(Product $product)
    {
         $messages = Message::with('user')
            ->where('product_id', $product->id)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('auction.show', compact('product', 'messages'));
    }
}
