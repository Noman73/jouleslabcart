<?php

namespace App\Services;

use App\Models\Coupon;
use Illuminate\Support\Facades\Session;

class CouponServices
{

    public static $instance=null;


    public function __construct()
    {

    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function applyAutoCoupon($cartDetails)
    {
//        Session::flush();

        [$cart, $total, $totalItems] = $cartDetails;

        $coupon = Coupon::where('is_auto_applied', true)
            ->where('expiry_date', '>=', now())
            ->where('minimum_total_price', '<=', $total)
            ->where('minimum_num_of_items', '<=', $totalItems)
            ->where('maximum_num_of_items', '>=', $totalItems)
            ->first();
//            dd($coupon);
        $discount = 0;
        $couponCode = null;

        if ($coupon) {
            $couponCode = $coupon->code;

            // calculate discount
            if ($coupon->discount_type === 'percentage') {
                $discount = ($total * $coupon->discount_amount / 100);

                // cap with maximum_discount_amount
                if ($coupon->maximum_discount_amount < $discount) {
                    $discount = min($discount, $coupon->maximum_discount_amount);
                }
            } else {
                $discount = $coupon->discount_amount;
            }

            session(['applied_coupon' => $coupon]);
        } else {
            session()->forget('applied_coupon');
        }

        $finalTotal = max(0, $total - $discount);

        return response()->json([
            'cart' => $cart,
//            'cart_total' => $total,
            'discount_amount' => floatval($discount),
//            'final_total' => $finalTotal,
            'applied_coupon' => $couponCode,
            "coupon_status" => 'success',
        ]);
    }

}

