<?php

namespace Module\MyTraining\Http\Resources;

use Module\MyTraining\Models\MyTrainingQuestion;
use Illuminate\Http\Resources\Json\ResourceCollection;

class QuestionMapCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return QuestionMapResource::collection($this->collection);
    }
}
