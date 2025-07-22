<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Events\NewMessage;

class MessageController extends Controller
{
   public function store(Request $request)
    {

        $request->validate([
            'message' => 'required|string',
            'product_id' => 'required|exists:products,id',
        ]);


        $message = Message::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'message' => $request->message,
        ]);

        broadcast(new NewMessage($message))->toOthers();

        return response()->json(['message' => $message->load('user')]);
    }
}
