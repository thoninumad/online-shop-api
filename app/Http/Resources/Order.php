<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Order extends JsonResource
{
    public function toArray($request)
    {
        return [
            'status' => 'success',
            'message' => 'order data',
            'data' => parent::toArray($request),
        ];
    }
}
