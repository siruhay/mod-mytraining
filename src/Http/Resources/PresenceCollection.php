<?php

namespace Module\MyTraining\Http\Resources;

use Module\MyTraining\Models\MyTrainingPresence;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PresenceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return PresenceResource::collection($this->collection);
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
                'combos' => MyTrainingPresence::mapCombos($request),

                /** the page data filter */
                'filters' => MyTrainingPresence::mapFilters(),

                /** the table header */
                'headers' => MyTrainingPresence::mapHeaders($request),

                /** the page icon */
                'icon' => MyTrainingPresence::getPageIcon('mytraining-presence'),

                /** the record key */
                'key' => MyTrainingPresence::getDataKey(),

                /** the page default */
                'recordBase' => MyTrainingPresence::mapRecordBase($request),

                /** the page statuses */
                'statuses' => MyTrainingPresence::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => MyTrainingPresence::getPageTitle($request, 'mytraining-presence'),

                /** the usetrash flag */
                'usetrash' => MyTrainingPresence::hasSoftDeleted(),
            ]
        ];
    }
}
