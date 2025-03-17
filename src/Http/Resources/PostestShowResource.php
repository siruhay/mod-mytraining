<?php

namespace Module\MyTraining\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\MyTraining\Models\MyTrainingPostest;
use Module\System\Http\Resources\UserLogActivity;

class PostestShowResource extends JsonResource
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
            /**
             * the record data
             */
            'record' => MyTrainingPostest::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => MyTrainingPostest::mapCombos($request, $this),

                'icon' => MyTrainingPostest::getPageIcon('mytraining-postest'),

                'key' => MyTrainingPostest::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => MyTrainingPostest::mapStatuses($request, $this),

                'title' => MyTrainingPostest::getPageTitle($request, 'mytraining-postest'),
            ],
        ];
    }
}
