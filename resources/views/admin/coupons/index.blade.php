@extends("admin.layout")
@section("main_content")
    <div class="max-w-5xl mx-auto py-6">
        <div class="flex justify-between mb-4">
            <h2 class="text-xl font-bold">Coupons</h2>
            <a href="{{ route('coupons.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Add Coupon</a>
        </div>

        <table class="w-full border-collapse border border-gray-200 text-sm">
            <thead class="bg-gray-100">
            <tr>
                <th class="border px-3 py-2 text-left">Code</th>
                <th class="border px-3 py-2 text-left">Type</th>
                <th class="border px-3 py-2 text-right">Amount</th>
                <th class="border px-3 py-2 text-center">Expiry</th>
                <th class="border px-3 py-2 text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($coupons as $coupon)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-3 py-2">{{ $coupon->code }}</td>
                    <td class="px-3 py-2">{{ ucfirst($coupon->discount_type) }}</td>
                    <td class="px-3 py-2 text-right">{{ $coupon->discount_amount }}</td>
                    <td class="px-3 py-2 text-center">{{ $coupon->expiry_date?->format('Y-m-d') ?? 'N/A' }}</td>
                    <td class="px-3 py-2 text-center">
                        <a href="{{ route('coupons.edit', $coupon) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('coupons.destroy', $coupon) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline ml-2" onclick="return confirm('Delete this coupon?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mt-4">{{ $coupons->links() }}</div>
    </div>
@endsection
