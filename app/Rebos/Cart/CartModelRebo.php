<?php

namespace App\Rebos\Cart;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CartModelRebo implements CartRebos{

    protected $items;
    public function __construct()
    {
        $this->items = collect([]);
    }

    public function get(){
        if (!$this->items->count()) {
            $this->items = Cart::with('product')->get();
        }
        return $this->items;
    }
    public function add(Product $product, $quantity = 1){
        $item = Cart::where('product_id',$product->id)->first();
        if (!$item) {
            $cart =  Cart::create([
                // 'cookie_id' => $this->getCookieId(),
                'user_id' => Auth::id(), 
                'product_id' => $product->id,
                'quantity' => $quantity
            ]);
            $this->get()->push($cart);
        }else {
            $item->increment('quantity',$quantity);
        }
        
    }
    public function update($id, $quantity){
        Cart::where('id',$id)
        ->update([
            'quantity' => $quantity ,
        ]);
    }
    public function delete($id){
        Cart::where('id',$id)
        ->delete();
    }
    public function empty(){
        Cart::query()->delete();
    }
    public function total():float{
        return (float) Cart::join('products','products.id','=','carts.product_id')
        ->selectRaw('SUM(products.price * carts.quantity) as total')
        ->value('total');
    }

    // protected function getCookieId(){
    //     $cookie_id = Cookie::get('cart_id');
    //     if (!$cookie_id) {
    //         $cookie_id = Str::uuid();
    //         // $time = Carbon::now()->addDays(30);
    //         Cookie::queue('cart_id',$cookie_id, 30 *24 * 60 );
    //     }
    //     return $cookie_id ;
    // }
}
