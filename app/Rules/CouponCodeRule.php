<?php

namespace App\Rules;

use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CouponCodeRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function __construct(public $cart)
    {

    }
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $code=$value;
        $coupon=Coupon::where('code',$code)->first();
        if(!$coupon){
            $fail("invalid coupon code");
        }
        if($coupon){
            if($coupon?->minimum_total_price > $this->totalAmount()){
                $fail("minimum cart amount is : ".number_format($coupon->minimum_total_price,2));
            }
            if($coupon?->maximum_num_of_items<count($this->cart)){
                $fail("maximum  ".$coupon?->maximum_num_of_items." items allowed for this coupon");
            }
            $expiry_date = $coupon->expiry_date; // from DB (timestamp)
            $isExpired = Carbon::parse($expiry_date)->isPast();
            if($isExpired){
                $fail("the coupon has expired");
            }
            if($coupon->minimum_num_of_items > count($this->cart)){
                $fail("minimum  ".$coupon?->minimum_num_of_items." items allowed for this coupon");
            }
            if($coupon->allowed_product_id){
                $exists = collect($this->cart)->contains('id', 6);
                if(!$exists){
                    $fail("this coupon doesn't exist for this product");
                }
            }
        }

    }

    public function totalAmount(): float
    {
        $cart=array_values(session('cart', []));

        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

        return $total;
    }
}
