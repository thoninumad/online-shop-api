<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Category extends JsonResource
{

    public function toArray($request)
    {
        $parent = parent::toArray($request);
        $data['products'] = $this->products()->where('status', 'PUBLISH')->paginate(8);
        $data = array_merge($parent, $data);
        return [
            'status' => 'success',
            'message' => 'category data',
            'data' => $data
        ];
    }
}
