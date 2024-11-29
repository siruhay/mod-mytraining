<?php

namespace Module\MyTraining\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\MyTraining\Models\MyTrainingPresence;
use Module\System\Http\Resources\UserLogActivity;

class PresenceShowResource extends JsonResource
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
            'record' => MyTrainingPresence::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => MyTrainingPresence::mapCombos($request, $this),

                'icon' => MyTrainingPresence::getPageIcon('mytraining-presence'),

                'key' => MyTrainingPresence::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => MyTrainingPresence::mapStatuses($request, $this),

                'title' => MyTrainingPresence::getPageTitle($request, 'mytraining-presence'),
            ],
        ];
    }
}
