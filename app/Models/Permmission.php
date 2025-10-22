<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permmission extends Model
{
    protected $fillable = [
        'name',
        'group_name',
        'description',
        'is_active',
    ];
}
