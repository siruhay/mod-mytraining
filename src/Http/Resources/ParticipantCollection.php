<?php

namespace Module\MyTraining\Http\Resources;

use Module\MyTraining\Models\MyTrainingParticipant;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ParticipantCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return ParticipantResource::collection($this->collection);
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function with($request): array
    {
        if ($request->has('initialized')) {
            return [];
        }

        return [
            'setups' => [
                /** the page combo */
                'combos' => MyTrainingParticipant::mapCombos($request),

                /** the page data filter */
                'filters' => MyTrainingParticipant::mapFilters(),

                /** the table header */
                'headers' => MyTrainingParticipant::mapHeaders($request),

                /** the page icon */
                'icon' => MyTrainingParticipant::getPageIcon('mytraining-participant'),

                /** the record key */
                'key' => MyTrainingParticipant::getDataKey(),

                /** the page default */
                'recordBase' => MyTrainingParticipant::mapRecordBase($request),

                /** the page statuses */
                'statuses' => MyTrainingParticipant::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => MyTrainingParticipant::getPageTitle($request, 'mytraining-participant'),

                /** the usetrash flag */
                'usetrash' => MyTrainingParticipant::hasSoftDeleted(),
            ]
        ];
    }
}
