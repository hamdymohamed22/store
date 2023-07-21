<?php

namespace App\Facades;

use App\Rebos\Cart\CartModelRebo;
use App\Rebos\Cart\CartRebos;
use Illuminate\Support\Facades\Facade;

class Cart extends Facade{


    protected static function getFacadeAccessor()
    {
        return CartModelRebo::class;
    }
}

?>