<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\translatable;



class Item extends Model
{
    use SoftDeletes , HasFactory,translatable;
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
    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function details()
    {
        return $this->hasOne(ItemDetail::class, 'id', 'id');
    }
    /**
     * Get the translatable attributes.
     *
     * @return array
     */
    public function getTranslatableAttributes(): array
    {
        return [
            'name',
            'description',
        ];
    }
}
