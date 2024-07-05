<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    use HasFactory;

    public function item()
    {
        return $this->hasOne(Item::class, 'id', 'item_id');
    }
}
