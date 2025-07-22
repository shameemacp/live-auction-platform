<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Product;
use App\Events\NewBidPlaced;
use Illuminate\Http\Request;

class BidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'product_id' => 'required|exists:products,id',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Check if bid is higher than current
        if ($request->amount <= $product->current_price) {
            return response()->json(['error' => 'Bid must be higher than current price.'], 422);
        }

       \Log::info('Creating bid', [
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'amount' => $request->amount
        ]);

        $bid = Bid::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'amount' => $request->amount,
        ]);

        // Update product's current price
        $product->current_price = $request->amount;

        // Optional: Auto time extension logic
        $secondsLeft = now()->diffInSeconds($product->end_time, false);
        if ($secondsLeft <= 10) {
            $product->end_time = now()->addSeconds(15); // Extend auction by 15 sec
        }

        $product->save();

        // Broadcast new bid to others
        broadcast(new NewBidPlaced($bid))->toOthers();

        return response()->json(['success' => true, 'bid' => $bid]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bid  $bid
     * @return \Illuminate\Http\Response
     */
    public function show(Bid $bid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bid  $bid
     * @return \Illuminate\Http\Response
     */
    public function edit(Bid $bid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bid  $bid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bid $bid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bid  $bid
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bid $bid)
    {
        //
    }
}
