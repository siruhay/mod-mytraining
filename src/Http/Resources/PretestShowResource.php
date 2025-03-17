<?php

namespace Module\MyTraining\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\MyTraining\Models\MyTrainingPretest;
use Module\System\Http\Resources\UserLogActivity;

class PretestShowResource extends JsonResource
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
            'record' => MyTrainingPretest::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => MyTrainingPretest::mapCombos($request, $this),

                'icon' => MyTrainingPretest::getPageIcon('mytraining-pretest'),

                'key' => MyTrainingPretest::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => MyTrainingPretest::mapStatuses($request, $this),

                'title' => MyTrainingPretest::getPageTitle($request, 'mytraining-pretest'),
            ],
        ];
    }
}
