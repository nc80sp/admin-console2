<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    public function items()
    {
        return $this->belongsToMany(Item::class, 'user_items', 'user_id', 'item_id')
            ->withPivot('amount');
    }

    public function follows()
    {
        return $this->hasMany(Follow::class, 'user_id', 'id');
    }

    public function mails()
    {
        return $this->belongsToMany(Mail::class, 'user_mails', 'user_id', 'mail_id')
            ->withPivot('received');
    }

    protected $guarded = [
        'id',
    ];
}
