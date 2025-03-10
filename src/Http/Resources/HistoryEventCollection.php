<?php

namespace Module\MyTraining\Http\Resources;

use Module\MyTraining\Models\MyTrainingHistoryEvent;
use Illuminate\Http\Resources\Json\ResourceCollection;

class HistoryEventCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return HistoryEventResource::collection($this->collection);
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
                'combos' => MyTrainingHistoryEvent::mapCombos($request),

                /** the page data filter */
                'filters' => MyTrainingHistoryEvent::mapFilters(),

                /** the table header */
                'headers' => MyTrainingHistoryEvent::mapHeaders($request),

                /** the page icon */
                'icon' => MyTrainingHistoryEvent::getPageIcon('mytraining-historyevent'),

                /** the record key */
                'key' => MyTrainingHistoryEvent::getDataKey(),

                /** the page default */
                'recordBase' => MyTrainingHistoryEvent::mapRecordBase($request),

                /** the page statuses */
                'statuses' => MyTrainingHistoryEvent::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => MyTrainingHistoryEvent::getPageTitle($request, 'mytraining-historyevent'),

                /** the usetrash flag */
                'usetrash' => MyTrainingHistoryEvent::hasSoftDeleted(),
            ]
        ];
    }
}
