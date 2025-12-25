<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\translatable;



class Category extends Model
{
    use HasFactory, SoftDeletes, translatable;
    
    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];
    public function items()
    {
        return $this->belongsToMany(Item::class);
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
