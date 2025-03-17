<?php

namespace Module\MyTraining\Http\Resources;

use Module\MyTraining\Models\MyTrainingPostest;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostestCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return PostestResource::collection($this->collection);
    }
}
