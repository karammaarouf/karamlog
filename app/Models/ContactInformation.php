<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInformation extends Model
{
    protected $table = 'contact_informations';
    protected $fillable = [
        'phone',
        'email',
        'whatsapp',
        'telegram',
        'facebook',
        'instagram',
        'tiktok',
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'id');
    }
}
