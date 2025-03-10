<?php

namespace Module\MyTraining\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\MyTraining\Models\MyTrainingHistoryEvent;
use Module\System\Http\Resources\UserLogActivity;

class HistoryEventShowResource extends JsonResource
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
            'record' => MyTrainingHistoryEvent::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => MyTrainingHistoryEvent::mapCombos($request, $this),

                'icon' => MyTrainingHistoryEvent::getPageIcon('mytraining-historyevent'),

                'key' => MyTrainingHistoryEvent::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => MyTrainingHistoryEvent::mapStatuses($request, $this),

                'title' => MyTrainingHistoryEvent::getPageTitle($request, 'mytraining-historyevent'),
            ],
        ];
    }
}
