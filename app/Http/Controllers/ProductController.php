<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('backend.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'start_price' => 'required|numeric',
            'end_time' => 'nullable|date',
        ]);

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'start_price' => $request->start_price,
            'current_price' => $request->start_price,
            'end_time' => $request->end_time,
        ]);

        return redirect()->route('products.index')->with('success', 'Product created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
       return view('backend.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
         $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'start_price' => 'required|numeric',
            'end_time' => 'nullable|date',
        ]);

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'start_price' => $request->start_price,
            'end_time' => $request->end_time,
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted.');
    }
}
