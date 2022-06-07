<?php

namespace App\Http\Resources\Kinsman;

use Illuminate\Http\Resources\Json\ResourceCollection;

class KinsmanCollection extends ResourceCollection
{
    public $collects = KinsmanResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function toArray($request)
    {
        return $this->collection;
    }
}
