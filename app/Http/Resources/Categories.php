<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Categories extends ResourceCollection
{

    public function toArray($request)
    {
        return [
            'status' => 'success',
            'message' => 'categories data',
            'data' => parent::toArray($request),
        ];
    }
}
