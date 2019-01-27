<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Provinces extends ResourceCollection
{

    public function toArray($request)
    {
        return [
            'status' => 'success',
            'message' => 'provinces data',
            'data' => parent::toArray($request),
        ];
    }
}
