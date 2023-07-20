<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => (string)$this->id,
            'type' => 'Product',
            'attributes'=> [
                'id'=> $this->id,
                'description'=> $this->description,
                'category'=> $this->category,
                'price'=>$this->price,
                'created_at'=> $this->created_at,
                'updated_at'=> $this->updated_at
            ]];
    }
}