<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserMailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'mail_id' => $this->id,
            'received' => $this->pivot->received,
            'created_at' => $this->pivot->created_at->format('Y/m/d H:m:i')
        ];
    }
}
