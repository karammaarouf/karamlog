<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemDetail extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'width',
        'height',
        'depth',
        'weight',
        'material',
        'color',
        'size',
        'shape',
        'type',
        'brand',
        'model',
        'serial_number',
        'other_details',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'id', 'id');
    }
}
