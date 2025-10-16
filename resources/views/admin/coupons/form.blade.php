@php
    // $coupon may be null for create
    $coupon = $coupon ?? null;
@endphp

@csrf

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <!-- Code -->
    <div>
        <label class="block text-sm font-medium mb-1">Code</label>
        <input name="code" value="{{ old('code', $coupon->code ?? '') }}"
               class="block w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-opacity-50 focus:ring-indigo-400"
               maxlength="250" />
        @error('code') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <!-- Coupon Type -->
    <div>
        <label class="block text-sm font-medium mb-1">Coupon Type</label>
        <select name="is_auto_applied"
                class="block w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-indigo-400">
            <option value="1" {{ old('is_auto_applied', $coupon->is_auto_applied ?? '') == 1 ? 'selected' : '' }}>Auto</option>
            <option value="0" {{ old('is_auto_applied', $coupon->is_auto_applied ?? '') == 0 ? 'selected' : '' }}>Manual</option>
        </select>
        @error('is_auto_applied') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <!-- Discount Type -->
    <div>
        <label class="block text-sm font-medium mb-1">Discount Type</label>
        <select name="discount_type"
                class="block w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-indigo-400">
            <option value="fixed" {{ old('discount_type', $coupon->discount_type ?? '') == 'fixed' ? 'selected' : '' }}>Fixed</option>
            <option value="percentage" {{ old('discount_type', $coupon->discount_type ?? '') == 'percentage' ? 'selected' : '' }}>Percentage</option>
        </select>
        @error('discount_type') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <!-- Discount Amount -->
    <div>
        <label class="block text-sm font-medium mb-1">Discount Amount</label>
        <input type="number" step="0.01" name="discount_amount" value="{{ old('discount_amount', $coupon->discount_amount ?? null) }}"
               class="block w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-indigo-400"  />
        @error('discount_amount') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <!-- Maximum Discount Amount -->
    <div>
        <label class="block text-sm font-medium mb-1">Maximum Discount Amount (optional)</label>
        <input type="number" step="0.01" name="maximum_discount_amount" value="{{ old('maximum_discount_amount', $coupon->maximum_discount_amount ?? '') }}"
               class="block w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-indigo-400" />
        @error('maximum_discount_amount') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <!-- Minimum Total Price -->
    <div>
        <label class="block text-sm font-medium mb-1">Minimum Total Price (optional)</label>
        <input type="number" step="0.01" name="minimum_total_price" value="{{ old('minimum_total_price', $coupon->minimum_total_price ?? '') }}"
               class="block w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-indigo-400" />
        @error('minimum_total_price') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <!-- Maximum Num Of Items -->
    <div>
        <label class="block text-sm font-medium mb-1">Maximum Number of Items (optional)</label>
        <input type="number" name="maximum_num_of_items" value="{{ old('maximum_num_of_items', $coupon->maximum_num_of_items ?? '') }}"
               class="block w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-indigo-400" />
        @error('maximum_num_of_items') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <!-- Minimum Num Of Items -->
    <div>
        <label class="block text-sm font-medium mb-1">Minimum Number of Items (optional)</label>
        <input type="number" name="minimum_num_of_items" value="{{ old('minimum_num_of_items', $coupon->minimum_num_of_items ?? '') }}"
               class="block w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-indigo-400" />
        @error('minimum_num_of_items') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <!-- Allowed Product -->
    <div>
        <label class="block text-sm font-medium mb-1">Allowed Product (optional)</label>

        {{-- prefer a select (pass $products => Product::pluck('name','id') from controller) --}}
        <select name="allowed_product_id"
                class="block w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-indigo-400">
            <option value="">-- Any product --</option>
            @if(isset($products))
                @foreach($products as $id => $name)
                    <option value="{{ $id }}" {{ old('allowed_product_id', $coupon->allowed_product_id ?? '') == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            @else
                <option value="{{ old('allowed_product_id', $coupon->allowed_product_id ?? '') }}">{{ old('allowed_product_id', $coupon->allowed_product_id ?? '') }}</option>
            @endif
        </select>
        @error('allowed_product_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <!-- Max Uses System -->
    <div>
        <label class="block text-sm font-medium mb-1">Max Uses (system) (optional)</label>
        <input type="number" name="max_uses_system" value="{{ old('max_uses_system', $coupon->max_uses_system ?? '') }}"
               class="block w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-indigo-400" />
        @error('max_uses_system') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <!-- Max Uses User -->
    <div>
        <label class="block text-sm font-medium mb-1">Max Uses (per user) (optional)</label>
        <input type="number" name="max_uses_user" value="{{ old('max_uses_user', $coupon->max_uses_user ?? '') }}"
               class="block w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-indigo-400" />
        @error('max_uses_user') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <!-- Expiry Date -->
    <div>
        <label class="block text-sm font-medium mb-1">Expiry Date (optional)</label>
        {{-- Use datetime-local to include time; convert on server if needed --}}
        <input type="datetime-local" name="expiry_date"
               value="{{ old('expiry_date', isset($coupon->expiry_date) ? $coupon->expiry_date->format('Y-m-d\TH:i') : '') }}"
               class="block w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-indigo-400" />
        @error('expiry_date') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
    </div>
</div>

<div class="mt-6 flex items-center space-x-3">
    <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-green-400">
        {{ $buttonText }}
    </button>
    <a href="{{ route('coupons.index') }}" class="text-sm text-gray-600 hover:underline">Cancel</a>
</div>
