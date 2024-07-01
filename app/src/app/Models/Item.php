<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_items', 'item_id', 'user_id')
            ->withPivot('amount');
        /*        return $this->belongsToMany(User::class, 'user_items')
                    ->as('user_item')
                    ->withPivot('amount');*/
    }

    protected $guarded = [
        'id',
    ];
}
