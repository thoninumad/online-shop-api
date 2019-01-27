<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Cities extends ResourceCollection
{

    public function toArray($request)
    {
        return [
            'status' => 'success',
            'message' => 'cities data',
            'data' => parent::toArray($request),
        ];
    }
}
