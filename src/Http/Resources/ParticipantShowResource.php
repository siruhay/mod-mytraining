<?php

namespace Module\MyTraining\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Module\MyTraining\Models\MyTrainingParticipant;
use Module\System\Http\Resources\UserLogActivity;

class ParticipantShowResource extends JsonResource
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
            'record' => MyTrainingParticipant::mapResourceShow($request, $this),

            /**
             * the page setups
             */
            'setups' => [
                'combos' => MyTrainingParticipant::mapCombos($request, $this),

                'icon' => MyTrainingParticipant::getPageIcon('mytraining-participant'),

                'key' => MyTrainingParticipant::getDataKey(),

                'logs' => $request->activities ? UserLogActivity::collection($this->activitylogs) : null,

                'softdelete' => $this->trashed() ?: false,

                'statuses' => MyTrainingParticipant::mapStatuses($request, $this),

                'title' => MyTrainingParticipant::getPageTitle($request, 'mytraining-participant'),
            ],
        ];
    }
}
