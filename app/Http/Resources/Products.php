<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Products extends ResourceCollection
{

    public function toArray($request)
    {
        return [
            'status' => 'success',
            'message' => 'products data',
            'data' => parent::toArray($request),
        ];
    }
}
