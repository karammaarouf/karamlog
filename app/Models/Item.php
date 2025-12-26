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
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
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
