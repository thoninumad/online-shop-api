<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{

    public function toArray($request)
    {
        $parent = parent::toArray($request);
        $data['categories'] = $this->categories;
        $data = array_merge($parent, $data);
        return [
            'status' => 'success',
            'message' => 'product data',
            'data' => $data,
        ];
    }
}
