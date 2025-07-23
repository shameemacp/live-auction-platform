@extends('backend.layouts.app')

@section('content')
    <div class="p-4 m-4">
            <div class="page-content">
                <div class="container-fluid">
                <h2>Live Auctions</h2>
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-md-4">
                            <div class="card p-3 mb-3">
                                <h4>{{ $product->name }}</h4>
                                <p>{{ $product->description }}</p>
                                <p>Current Price: ${{ $product->current_price }}</p>
                                <p>Ends In: <span data-time="{{ $product->end_time }}"></span></p>
                                <a href="{{ route('auction.show', $product->id) }}" class="btn btn-primary">Join Auction</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                  </div> <!-- container-fluid -->
    </div>
            <!-- End Page-content -->
@endsection

@section('scripts')
<script>
    document.querySelectorAll('[data-time]').forEach(el => {
        const end = new Date(el.dataset.time);
        const interval = setInterval(() => {
            const now = new Date();
            const distance = end - now;
            if (distance <= 0) {
                el.textContent = "Auction Ended";
                clearInterval(interval);
                return;
            }
            const mins = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const secs = Math.floor((distance % (1000 * 60)) / 1000);
            el.textContent = `${mins}m ${secs}s`;
        }, 1000);
    });
</script>
@endsection
