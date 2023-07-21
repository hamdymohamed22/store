<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){

    }
    public function show(Product $product){
        // $product = Product::findOrFail($id);
        if ($product->status != 'active') {
            return response('not found',404);
        }
        return view('front.products.show',compact('product'));
    }
}
