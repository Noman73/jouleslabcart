@extends("admin.layout")
@section("main_content")
    <div class="max-w-4xl mx-auto py-6">
        <h2 class="text-xl font-bold mb-4">Edit Coupon</h2>
        <form action="{{ route('coupons.update', $coupon) }}" method="POST">
            @method('PUT')
            @include('admin.coupons.form', ['buttonText' => 'Update'])
        </form>
    </div>

@endsection
