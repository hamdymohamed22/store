<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Facades\Cart;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Throwable;

class ProductQuantity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    // public function handle( $order): void
    public function handle($event): void
    {
        $order = $event->order;

        try {
            foreach ($order->products as $product) {
                $product->decrement('quantity',$product->pivot->quantity);
    
                // Product::where('id',$items->product_id)
                // ->update([
                //     'quantity' => DB::raw("quantity - $items->quantity ")
                // ]);
            }
        } catch (Throwable $e) {
            
        }
    }
}
