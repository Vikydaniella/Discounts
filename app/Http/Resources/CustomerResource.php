<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => (string)$this->id,
            'type' => 'Product',
            'attributes'=> [
            'name' => $this->name,
            'since' => $this->since,
            'revenue' => $this->revenue,
            'created_at'=> $this->created_at,
            'updated_at'=> $this->updated_at
            ]];
    }
}
