<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'code',
        'quantity',
        'is_active',
        'discount',
    ];
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
