<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        // eager loading [with]
        $products = Product::active()->with('category')->latest()->take(8)->get();
        return view('front.index',compact('products'));
    }
}
