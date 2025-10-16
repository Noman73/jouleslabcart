<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $couponId = $this->route('coupon')?->id;
        return [
            'code' => 'required|string|max:250|unique:coupons,code,' . $couponId,
            'discount_type' => 'required|string|in:fixed,percentage',
            'discount_amount' => 'required|numeric|min:0',
            'maximum_discount_amount' => 'required|numeric|min:0',
            'minimum_total_price' => 'required|numeric|min:0',
            'maximum_num_of_items' => 'required|integer|min:0',
            'minimum_num_of_items' => 'required|integer|min:0',
            'allowed_product_id' => 'nullable|integer|exists:products,id',
            'max_uses_system' => 'required|integer|min:0',
            'max_uses_user' => 'required|integer|min:0',
            'is_auto_applied' => 'required|boolean|in:0,1',
            'expiry_date' => 'required|date|after_or_equal:today',
        ];
    }
}
