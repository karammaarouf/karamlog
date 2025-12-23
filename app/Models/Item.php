<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use SoftDeletes , HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'code',
        'quantity',
        'is_active',
        'discount',
    ];
    protected $casts = [
        'is_active' => 'boolean',
        'discount' => 'decimal:2',
        'price' => 'decimal:2',
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
