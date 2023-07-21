<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Observers\CartObserver;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'user_id', 'product_id', 'cookie_id', 'quantity',
        'options',
    ];

    // observes & listener

    // createing,created / updating,updated /== saving,saved
    // deleating,deleated / restoring,restored / retrieved=show

    public static function booted()
    {

        static::addGlobalScope('cookie_id',function(Builder $builder){
            $builder->where('cookie_id', Cart::getCookieId());
        }); 
        static::observe(CartObserver::class);

        // static::creating(function (Cart $cart) {
        //     $cart->id = Str::uuid();
        // });
    }


    public static function getCookieId()
    {
        $cookie_id = Cookie::get('cart_id');
        if (!$cookie_id) {
            $cookie_id = Str::uuid();
            Cookie::queue('cart_id', $cookie_id, 30 * 24 * 60);
        }
        return $cookie_id;
    }



    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
