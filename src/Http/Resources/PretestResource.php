<?php

namespace Module\MyTraining\Http\Resources;

use Module\MyTraining\Models\MyTrainingPretest;
use Illuminate\Http\Resources\Json\JsonResource;

class PretestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return MyTrainingPretest::mapResourceShow($request, $this);
    }
}
