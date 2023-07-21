<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = [];
    // the hidden tabels when show json data
    protected $hidden = ['created_at','updated_at','deleted_at'];
    protected $append = ['image_url'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function scopeActive(Builder $builder)
    {
        $builder->where('status', 'active')->get();
    }
    // global scope
    public static function booted()
    {
        static::addGlobalScope('user_store', function (Builder $builder) {
            $user = Auth::user();
            if ($user && $user->store_id) {
                $builder->where('store_id', $user->store_id);
            }
        });
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return "url";
        } else {
            return asset("storage/$this->image");
        }
    }
    public function getDiscountAttribute()
    {
        if (!$this->compare_price) {
            return 0;
        } else {
            return round(100 - (100 * $this->price / $this->compare_price));
        }
    }

    public function scopeFilter(Builder $builder, $filters)
    {
        $options = array_merge([
            'store_id' => null,
            'category_id' => null,
            'status' => 'active'
        ], $filters);

        $builder->when($options['store_id'], function ($builder, $value) {
            $builder->where('store_id', $value);
        });

        $builder->when($options['category_id'], function ($builder, $value) {
            $builder->where('category_id', $value);
        });

        $builder->when($options['status'], function ($builder, $value) {
            $builder->where('status', $value);
        });
    }
}
