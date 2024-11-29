<?php

namespace Module\MyTraining\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\MyTraining\Models\MyTrainingEvent;
use Module\System\Http\Resources\UserLogActivity;

class EventShowResource extends JsonResource
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
            'record' => MyTrainingEvent::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => MyTrainingEvent::mapCombos($request, $this),

                'icon' => MyTrainingEvent::getPageIcon('mytraining-event'),

                'key' => MyTrainingEvent::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => MyTrainingEvent::mapStatuses($request, $this),

                'title' => MyTrainingEvent::getPageTitle($request, 'mytraining-event'),
            ],
        ];
    }
}
