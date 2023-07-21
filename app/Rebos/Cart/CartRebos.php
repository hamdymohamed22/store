<?php 

namespace App\Rebos\Cart ;

use App\Models\Product;
use Illuminate\Support\Collection;

interface CartRebos {
    public function get();
    public function add(Product $product, $quantity = 1);
    public function update($id , $quantity);
    public function delete($id);
    public function empty();
    public function total():float;
}

?>