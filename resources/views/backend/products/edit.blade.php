@extends('backend.layouts.app')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
            <h2>Edit Product</h2>

            <form method="POST" action="{{ route('products.update', $product->id) }}">
                @csrf
                @method('PUT')

                <div class="form-group mb-2">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $product->name }}" required />
                </div>
                <div class="form-group mb-2">
                    <label>Description</label>
                    <textarea name="description" class="form-control">{{ $product->description }}</textarea>
                </div>
                <div class="form-group mb-2">
                    <label>Start Price</label>
                    <input type="number" name="start_price" class="form-control" value="{{ $product->start_price }}" step="0.01" required />
                </div>
                <div class="form-group mb-2">
                    <label>End Time</label>
                    <input type="datetime-local" name="end_time" class="form-control" value="{{ \Carbon\Carbon::parse($product->end_time)->format('Y-m-d\TH:i') }}" />
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div> <!-- container-fluid -->
    </div>
            <!-- End Page-content -->
</div>
@endsection
