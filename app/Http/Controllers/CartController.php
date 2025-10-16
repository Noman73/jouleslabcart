<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Product;
use App\Rules\CouponCodeRule;
use App\Services\CouponServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function getCart()
    {
        $cart = session('cart', []);
        $appliedCoupon = session('applied_coupon');
        $cartDetails = $this->getCartDetails();

        return CouponServices::getInstance()->applyAutoCoupon($cartDetails);

        //   return response()->json([
        //       'cart' => array_values($cart), // Ensure it's an array
        //            'applied_coupon' => $appliedCoupon,
        //   ]);
    }
    public function addToCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|integer|exists:products,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $productId = $request->product_id;
        $product = Product::findOrFail($productId);

        $cart = session('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => 1,
            ];
        }

        session(['cart' => $cart]);
        $cartDetails = $this->getCartDetails();
        return CouponServices::getInstance()->applyAutoCoupon($cartDetails);
//        return response()->json([
//            'cart' => array_values($cart),
//            'applied_coupon' => session('applied_coupon'),
//            'discount_amount' => $cartDetails['discount_amount'],
//        ]);
    }
    public function removeFromCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $productId = $request->product_id;

        $cart = session('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
        }

        session(['cart' => $cart]);
        $cartDetails = $this->getCartDetails();
        return CouponServices::getInstance()->applyAutoCoupon($cartDetails);
    }
    public function updateCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|integer',
            'change' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $productId = $request->product_id;
        $change = $request->change;

        $cart = session('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $change;

            if ($cart[$productId]['quantity'] <= 0) {
                unset($cart[$productId]);
            }
        }

        session(['cart' => $cart]);
        $cartDetails = $this->getCartDetails();
        return CouponServices::getInstance()->applyAutoCoupon($cartDetails);

    }
    public function applyCoupon(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'code' => ['required','string','max:250', new CouponCodeRule(array_values(session('cart', [])))],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $total=$this->totalAmount();



        // Define available coupons (or fetch from DB)
        $coupons = Coupon::where('code', $request->code)->first();
        $amount=0;

        if($coupons?->discount_type==="fixed"){
            $amount=$coupons?->discount_amount;
        }
        if($coupons?->discount_type==="percentage"){
            $amount=($this->totalAmount()* $coupons->discount_amount)/100;
            if($coupons->maximum_discount_amount<$amount){
                $amount=$coupons->maximum_discount_amount;
            }
        }
        array_values(session('cart', []));
        if($coupons){
            session(['applied_coupon' => $request->code]);
        }


        return response()->json([
            'cart' => array_values(session('cart', [])),
            'discount_amount' => floatval($amount),
            "coupon_status"=>"success",
            "applied_coupon"=> session('applied_coupon'),
        ]);
    }
    public function  getCartDetails()
    {
        $cart = array_values(session('cart', []));
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $totalItems = collect($cart)->sum(fn($item) => $item['quantity']);

        return [$cart, $total, $totalItems];
    }

    public function totalAmount()
    {
         $cart=array_values(session('cart', []));

        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

        return $total;
    }


}
