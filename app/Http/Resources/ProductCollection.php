<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'content' => $this->collection,
            'links' => [
                'current_page' => $this->currentPage(),
                'last_page' => $this->lastPage(),
                'prev_page_url' =>  $this->previousPageUrl(),
                'next_page_url' =>  $this->nextPageUrl(),
                'total' => $this->total()
            ]
        ];
    }
}
