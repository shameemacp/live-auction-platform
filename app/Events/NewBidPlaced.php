<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Bid;

class NewBidPlaced
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $bid;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Bid $bid)
    {
      $this->bid = $bid->load('user', 'product');
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    // public function broadcastOn()
    // {
    //     return new PrivateChannel('channel-name');
    // }
     public function broadcastOn(): Channel
    {
        return new Channel('product.' . $this->bid->product_id);
    }
    public function broadcastAs()
    {
        return 'NewBidPlaced';
    }
}
