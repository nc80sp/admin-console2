<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    public $preserveKeys = true;

    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'type' => $this->type,
            'value' => $this->value,
            'desc' => $this->desc,
        ];
    }
}
