<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Rebos\Cart\CartModelRebo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $rebos = new CartModelRebo;
        $rebos = App::make('cart');
        $items =  $rebos->get();
        $total = $rebos->total();
        return view('front.cart', compact('items','total'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'nullable|integer|min:1'
        ]);

        $quantity = $request->post('quantity');
        $product = Product::findOrFail($request->post('product_id'));
        $rebos = new CartModelRebo;
        $rebos->add($product , $quantity);
        return redirect()->back()->with('success', 'stored succesfully');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request , $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);
        $quantity = $request->post('quantity');
        $rebos = new CartModelRebo;
        $rebos->update($id, $quantity);
        return redirect()->back()->with('success','updated succesfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rebos = new CartModelRebo;
        $rebos->delete($id);
        return redirect()->back()->with('success', 'deleted succesfully');
    }
}
