<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\translatable;


class Group extends Model
{
    use HasFactory, SoftDeletes,translatable;
    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];
    public function items()
    {
        return $this->hasMany(Item::class);
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
