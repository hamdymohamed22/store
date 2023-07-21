<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Order extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = [];

    // relations

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'guest'
        ]);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class , 'order_products')
        ->using(OrderProduct::class)
        ->withPivot('product_name','price','quantity','options');
    }
    public function addresses()
    {
        return $this->hasMany(OrderAddress::class);
    }
    public function billingAddress(){
        return $this->hasOne(OrderAddress::class ,'order_id' ,'id')
        ->where('address_type','billing');
    }
    public function shippingAddress(){
        return $this->hasOne(OrderAddress::class ,'order_id' ,'id')
        ->where('address_type','shipping');
    }


    // observers

    public static function booted()
    {
        static::creating(function (Order $order) {
            $order->number = Order::getNextNumber();
        });
    }

    // used function 

    public static function getNextNumber()
    {
        // $year = date('Y');
        $year = Carbon::now()->year ;
        $max_number = Order::whereYear('created_at',$year)->max('number');
        if ($max_number) {
            return $max_number + 1 ;
        }else {
            return $year . '0001';
        }
        
    }
}
