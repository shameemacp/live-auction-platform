@extends('backend.layouts.app')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <h2>Add New Product</h2>

                <form method="POST" action="{{ route('products.store') }}">
                    @csrf
                    <div class="form-group mb-2">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" required />
                    </div>
                    <div class="form-group mb-2">
                        <label>Description</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                    <div class="form-group mb-2">
                        <label>Start Price</label>
                        <input type="number" name="start_price" class="form-control" step="0.01" required />
                    </div>
                    <div class="form-group mb-2">
                        <label>End Time</label>
                        <input type="datetime-local" name="end_time" class="form-control" />
                    </div>

                    <button type="submit" class="btn btn-success">Create</button>
                </form>
            </div> <!-- container-fluid -->
        </div>
            <!-- End Page-content -->
</div>
@endsection
