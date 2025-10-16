<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $coupons=[];
        return view('home', compact('products','coupons'));
    }
}
