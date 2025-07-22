@extends('backend.layouts.app')

@section('content')
    <div class="">
            <div class="page-content">
                <div class="container-fluid">

                <h2 style="text-align: center">All Products</h2>          
                <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add Product</a>
            <div class="row">

                @foreach($products as $product)
                   <div class="col-md-4">
                            <div class="card p-3 mb-3">
                        <h4 style="text-align:center;">{{ $product->name }}</h4>
                        <p>{{ $product->description }}</p>
                        <p><strong>Start Price:</strong> ${{ $product->start_price }}</p>
                        <p><strong>Ends At:</strong> {{ $product->end_time }}</p>

                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                        <br>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Delete this?')" class="btn btn-danger">Delete</button>
                        </form>
                        </div>
                    </div>
                @endforeach
            </div>
                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
    </div>
@endsection
