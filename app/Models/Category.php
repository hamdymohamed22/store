<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory ,SoftDeletes;
    protected $guarded = ['id'];
    protected $fillable = [];

    public function products(){
        return $this->hasMany(Product::class);
    }
    public function parent(){
        return $this->belongsTo(Category::class , 'parent_id','id')
        ->withDefault([
            'name' => '_'
        ]);
    }
    public function children(){
        return $this->hasMany(Category::class , 'parent_id','id');
    }

    public function scopeRel(Builder $builder){
        $builder->leftJoin('categories as parents' ,'parents.id', '=', 'categories.parent_id')
        ->select([
            'categories.*',
            'parents.name as parent_name'
        ]);
    }

    public function scopeFilter(Builder $builder , $data){

        if ($data['name'] ?? false) {
            $builder->where('name', 'LIKE', "%{$data['name']}%");
        }
        if ($data['status'] != '') {
            $builder->where('status', "{$data['status']}");
        }
        if ($data['status'] != '' && $data['name'] != '') {
            $builder->where('name', 'LIKE', "%{$data['name']}%")->where('status', "{$data['status']}");
        }
    }

    public static function rules($id = 0){
        return [
            'name' => "required|string|unique:categories,name,$id",
            'description' => "nullable|string|filter:html",
            'parent_id' => 'nullable|numeric|exists:categories,id',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg',
            'status' => 'required|in:active,inactive'
        ] ;
    }

    // public function category(){
    //     return $this->hasMany(Category::class);
    // }
}
