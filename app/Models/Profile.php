<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = [];

    public function user()
    {
        return $this->belongsTo(Profile::class);
    }
}
