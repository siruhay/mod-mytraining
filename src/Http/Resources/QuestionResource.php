<?php

namespace Module\MyTraining\Http\Resources;

use Module\MyTraining\Models\MyTrainingQuestion;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return MyTrainingQuestion::mapResource($request, $this);
    }
}
