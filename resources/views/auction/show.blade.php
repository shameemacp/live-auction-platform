@extends('backend.layouts.app')

@section('content')
    <div class="p-4 m-4">
            <div class="page-content">
                <div class="container-fluid">
                <h2>{{ $product->name }}</h2>
                <p>{{ $product->description }}</p>

                <h4>Current Price: <span id="current-price">${{ $product->current_price }}</span></h4>
                <h4>
                Time Left: <span id="countdown-timer"></span>
                </h4>
                <form id="bid-form" class="d-flex gap-2 align-items-center">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="number" name="amount" step="0.01" class="form-control w-25" required>
                    <button type="submit" class="btn btn-success">Place Bid</button>
                </form>

                <h4 class="mt-4">Live Chat</h4>
                <div class="chat-box border p-3 mb-3 bg-light" style="height: 250px; overflow-y: scroll;" id="chat-box">
                    @foreach($messages as $msg)
                        @if($msg->user_id === auth()->id())
                            <div class="text-end mb-2">
                                <span class="badge bg-primary">{{ $msg->user->name }}</span>
                                <div class="bg-primary text-white d-inline-block rounded px-3 py-2 mt-1">
                                    {{ $msg->message }}
                                </div>
                            </div>
                        @else
                            <div class="text-start mb-2">
                                <span class="badge bg-secondary">{{ $msg->user->name }}</span>
                                <div class="bg-light border d-inline-block rounded px-3 py-2 mt-1">
                                    {{ $msg->message }}
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <form id="chat-form" class="d-flex gap-2">
                    <input type="text" id="chat-input" class="form-control" placeholder="Type your message..." required>
                    <button type="submit" class="btn btn-primary">Send</button>
                </form>

         </div> <!-- container-fluid -->
    </div>
            <!-- End Page-content -->
</div>
@endsection

@section('scripts')
<script>
document.getElementById('bid-form').addEventListener('submit', function (e) {
    e.preventDefault();

    const form = this;
    const formData = new FormData(form);

    fetch("{{ route('bids.store') }}", {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Bid placed!');
            console.log('BID RESPONSE:', data);
        } else {
            alert(data.error || 'Bid failed.');
        }
    })
    .catch(err => {
        console.error('ERROR:', err);
        alert('Server error. See console.');
    });
});

console.log("Echo script loaded");

Echo.channel('product.{{ $product->id }}')
    .listen('.NewBidPlaced', (e) => {
        console.log('Real-time bid received:', e.bid);
        document.getElementById('current-price').textContent = '$' + e.bid.amount;
    });
</script>
<script>
let endTime = new Date("{{ $product->end_time }}");

function updateCountdown(endTime) {
    const timerEl = document.getElementById('countdown-timer');
    const interval = setInterval(() => {
        const now = new Date();
        const distance = endTime - now;

        if (distance <= 0) {
            timerEl.textContent = "Auction Ended";
            clearInterval(interval);
            return;
        }

        const mins = Math.floor((distance / 1000 / 60) % 60);
        const secs = Math.floor((distance / 1000) % 60);
        timerEl.textContent = `${mins}m ${secs}s`;
    }, 1000);
}

updateCountdown(endTime);

// Real-time time extension support
Echo.channel('product.{{ $product->id }}')
    .listen('.AuctionTimeExtended', (e) => {
        endTime = new Date(e.newEndTime);
        updateCountdown(endTime); // Reset countdown
    });
</script>

<script>
document.getElementById('chat-form').addEventListener('submit', function (e) {
    e.preventDefault();
    const input = document.getElementById('chat-input');
    const msg = input.value.trim();
    if (!msg) return;

    input.value = '';

    fetch('/messages', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            product_id: {{ $product->id }},
            message: msg
        })
    });
});

// Listen for real-time messages
Echo.channel('product.{{ $product->id }}')
    .listen('.NewMessage', (e) => {
        const chat = document.getElementById('chat-box');
        const isMine = e.message.user.id === {{ auth()->id() }};
        
        const msgHTML = `
            <div class="${isMine ? 'text-end' : 'text-start'} mb-2">
                <span class="badge ${isMine ? 'bg-primary' : 'bg-secondary'}">${e.message.user.name}</span>
                <div class="${isMine ? 'bg-primary text-white' : 'bg-light border'} d-inline-block rounded px-3 py-2 mt-1">
                    ${e.message.message}
                </div>
            </div>
        `;

        chat.innerHTML += msgHTML;
        chat.scrollTop = chat.scrollHeight;
    });

</script>



@endsection
