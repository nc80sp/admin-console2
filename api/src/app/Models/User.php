<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;
    use HasApiTokens;

    public function items()
    {
        return $this->belongsToMany(Item::class, 'user_items', 'user_id', 'item_id')
            ->withPivot('amount')->withPivot('updated_at');
    }

    public function follows()
    {
        return $this->hasMany(Follow::class, 'user_id', 'id');
    }

    public function mails()
    {
        return $this->belongsToMany(Mail::class, 'user_mails', 'user_id', 'mail_id')
            ->withPivot('received')->withPivot('created_at');
    }

    protected $guarded = [
        'id',
    ];
}
