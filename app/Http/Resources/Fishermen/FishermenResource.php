<?php

namespace App\Http\Resources\Fishermen;

use Illuminate\Http\Resources\Json\JsonResource;

class FishermenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'no_tlp' => $this->no_tlp,
            'location' => [
                'id' => $this->location->id,
                'name' => $this->location->name
            ],
            'product' => [
                'id' => $this->product->id,
                'name' => $this->product->name
            ],
            'tool' => $this->tool,
            'family_amount' => $this->family_amount,
            'image' => $this->image,
            'status' => $this->status
        ];
    }
}
