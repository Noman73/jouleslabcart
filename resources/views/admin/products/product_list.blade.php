@extends("admin.layout")

@section("main_content")
    <div class="flex justify-between mb-4">
        <h2 class="text-xl font-bold">Product List</h2>
        <a href="{{ route('product.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Add Products</a>
    </div>
    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="w-full border-collapse border border-gray-200 text-sm">
            <thead class="bg-gray-100">
            <tr>
                <th class="text-left py-3 px-4">#</th>
                <th class="text-left py-3 px-4">Name</th>
                <th class="text-left py-3 px-4">Price</th>
                <th class="text-left py-3 px-4">Image</th>
                <th class="text-left py-3 px-4">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($products as $product)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-2 px-3">{{ $loop->iteration }}</td>
                    <td class="py-2 px-3">{{ $product->name }}</td>
                    <td class="py-2 px-3">৳{{ number_format($product->price, 2) }}</td>
                    <td class="py-2 px-3">
                        @if($product->image)
                            <img src="{{ asset('storage/'.$product->image) }}" class="w-12 h-12 rounded-md object-cover">
                        @else
                            <span class="text-gray-400 italic">No Image</span>
                        @endif
                    </td>
                    <td class="px-3 py-2 text-center">
                        <a href="{{ route('product.edit', $product) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('product.destroy', $product) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline ml-2" onclick="return confirm('Delete this coupon?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-gray-500 py-6">No products found</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $products->links() }}
    </div>
@endsection
