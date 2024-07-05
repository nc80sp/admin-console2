<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMail extends Model
{
    use HasFactory;

    public function mail()
    {
        return $this->hasOne(Mail::class, 'id', 'mail_id');
    }

    protected $guarded = [
        'id'
    ];
}
