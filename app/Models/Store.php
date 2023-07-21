<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Store extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = ['id'];
    protected $fillable = [];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
