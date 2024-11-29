<?php

namespace Module\MyTraining\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\MyTraining\Models\MyTrainingRundown;
use Module\System\Http\Resources\UserLogActivity;

class RundownShowResource extends JsonResource
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
            'record' => MyTrainingRundown::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => MyTrainingRundown::mapCombos($request, $this),

                'icon' => MyTrainingRundown::getPageIcon('mytraining-rundown'),

                'key' => MyTrainingRundown::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => MyTrainingRundown::mapStatuses($request, $this),

                'title' => MyTrainingRundown::getPageTitle($request, 'mytraining-rundown'),
            ],
        ];
    }
}
