<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MailResource extends JsonResource
{
    public $preserveKeys = true;

    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'body' => $this->body,
            'item_id' => $this->item_id,
            'amount' => $this->amount
        ];
    }
}
