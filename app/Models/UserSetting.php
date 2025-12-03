<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    protected $fillable = [
        'user_id',
        'layout',
        'sidebar_type',
        'icon',
        'mode',
        'color',
        'locale',
    ];
    protected $casts = [
        'layout' => 'string',
        'sidebar_type' => 'string',
        'icon' => 'string',
        'mode' => 'string',
        'color' => 'string',
        'locale' => 'string',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
