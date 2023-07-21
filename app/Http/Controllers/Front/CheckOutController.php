<?php

namespace App\Http\Controllers\Front;

use App\Events\OrderCreated;
use App\Facades\Cart;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Rebos\Cart\CartModelRebo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Intl\Countries;

class CheckOutController extends Controller
{
    public function go_checkout()
    {
        $rebos = App::make('cart');

        $cart = Cart::get();
        $total = $rebos->total();
        $countries =  Countries::getNames();
        if (!$cart->count() == 0) {
            return view('front.checkout', compact('cart','total', 'countries'));
        }else {
            return redirect()->back()->with('info' , 'no carts');
        }
    }

    public function store(Request $request, CartModelRebo $cart)
    {

        $request->validate([
            // 'address.billing.first_name' => 'required|string',
            // 'address.billing.last_name' => 'required|string',
            // 'address.billing.email' => 'required|email|exists:users,email',
            // 'address.billing.phone' => 'required',
            // 'address.billing.state' => 'nullable|string',
            // 'address.billing.city' => 'nullable|string',
            // 'address.billing.country' => 'nullable|string',
            // 'address.billing.postal_code' => 'required|integer',
            // 'address.billing.str_address' => 'required|string',
            // //shippig
            // 'address.shippin.first_name' => 'required|string',
            // 'address.shippin.last_name' => 'required|string',
            // 'address.shippin.email' => 'required|email|exists:users,email',
            // 'address.shippin.phone' => 'required',
            // 'address.shippin.state' => 'nullable|string',
            // 'address.shippin.city' => 'nullable|string',
            // 'address.shippin.country' => 'nullable|string',
            // 'address.shippin.postal_code' => 'required|integer',
            // 'address.shippin.str_address' => 'required|string',
        ]);

        // get all items from cart 

        $items = $cart->get()->all();
        // dd($items);
        DB::beginTransaction();
        try {
            foreach ($items as $key => $cart_items) {
                // order creating
                $order = Order::create([
                    'store_id' => $cart_items->product->store_id,
                    'user_id' => Auth::id(),
                    'payment_method' => 'cod'
                ]);
                // order items creating 
                foreach ($cart_items as $item) {
                    OrderProduct::create([
                        'order_id' => $order->id,
                        'product_id' =>$cart_items->product->store_id,
                        'product_name' => $cart_items->product->name,
                        'price' => $cart_items->product->price,
                        'quantity' => $cart_items->quantity
                    ]);
                }
                foreach ($request->post('address') as $type => $address) {
                    $address['address_type'] = $type;
                    $order->addresses()->create($address);
                }
               
            }
            // event('order_created',$order);
            event( new OrderCreated($order));

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            dd($e);
        }

        return redirect()->route('front.home');
    }
}
