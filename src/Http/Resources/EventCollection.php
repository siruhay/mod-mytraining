<?php

namespace Module\MyTraining\Http\Resources;

use Module\MyTraining\Models\MyTrainingEvent;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EventCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return EventResource::collection($this->collection);
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
                'combos' => MyTrainingEvent::mapCombos($request),

                /** the page data filter */
                'filters' => MyTrainingEvent::mapFilters(),

                /** the table header */
                'headers' => MyTrainingEvent::mapHeaders($request),

                /** the page icon */
                'icon' => MyTrainingEvent::getPageIcon('mytraining-event'),

                /** the record key */
                'key' => MyTrainingEvent::getDataKey(),

                /** the page default */
                'recordBase' => MyTrainingEvent::mapRecordBase($request),

                /** the page statuses */
                'statuses' => MyTrainingEvent::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => MyTrainingEvent::getPageTitle($request, 'mytraining-event'),

                /** the usetrash flag */
                'usetrash' => MyTrainingEvent::hasSoftDeleted(),
            ]
        ];
    }
}
