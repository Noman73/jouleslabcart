@extends("admin.layout")
@section("main_content")
        <div class="max-w-4xl mx-auto py-6">
            <h2 class="text-xl font-bold mb-4">Create Coupon</h2>
            <form action="{{ route('coupons.store') }}" method="POST">
                @include('admin.coupons.form', ['buttonText' => 'Save'])
            </form>
        </div>

@endsection
