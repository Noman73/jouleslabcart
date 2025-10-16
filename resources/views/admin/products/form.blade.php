<div class="space-y-6">
    {{-- Product Name --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Product Name</label>
        <input type="text" name="name"
               value="{{ old('name', $product->name ?? '') }}"
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
               placeholder="Enter product name">
        @error('name')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Price --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Price</label>
        <input type="number" step="0.01" name="price"
               value="{{ old('price', $product->price ?? '') }}"
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
               placeholder="Enter product price">
        @error('price')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Image --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Product Image</label>
        <input type="file" name="image"
               class="w-full border border-gray-300 rounded-lg file:mr-4 file:py-2 file:px-4
                      file:rounded-md file:border-0 file:text-sm file:font-semibold
                      file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer
                      focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" />

        @if(!empty($product->image))
            <img src="{{ asset('storage/'.$product->image) }}"
                 class="w-20 h-20 mt-3 rounded-md object-cover border border-gray-200 shadow-sm">
        @endif

        @error('image')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>

{{-- Buttons --}}
<div class="mt-8 flex items-center gap-4">
    <button type="submit"
            class="bg-blue-600 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 transition">
        Save
    </button>
    <a href="{{ route('product.index') }}"
       class="bg-gray-200 text-gray-700 px-6 py-2.5 rounded-lg font-medium hover:bg-gray-300 transition">
        Cancel
    </a>
</div>
