@extends('admin.layout')
@section('main_content')
    <div class="max-w-lg mx-auto bg-white p-8 rounded-2xl shadow-md">
        <h2 class="text-2xl font-bold mb-6">
            {{ isset($product) ? 'Edit Product' : 'Add Product' }}
        </h2>

        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
           @csrf
            <!-- Product Name -->
           @include('admin.products.form')
        </form>
    </div>
@endsection
