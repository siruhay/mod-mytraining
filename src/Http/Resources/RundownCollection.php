<?php

namespace Module\MyTraining\Http\Resources;

use Module\MyTraining\Models\MyTrainingRundown;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RundownCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return RundownResource::collection($this->collection);
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
                'combos' => MyTrainingRundown::mapCombos($request),

                /** the page data filter */
                'filters' => MyTrainingRundown::mapFilters(),

                /** the table header */
                'headers' => MyTrainingRundown::mapHeaders($request),

                /** the page icon */
                'icon' => MyTrainingRundown::getPageIcon('mytraining-rundown'),

                /** the record key */
                'key' => MyTrainingRundown::getDataKey(),

                /** the page default */
                'recordBase' => MyTrainingRundown::mapRecordBase($request),

                /** the page statuses */
                'statuses' => MyTrainingRundown::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => MyTrainingRundown::getPageTitle($request, 'mytraining-rundown'),

                /** the usetrash flag */
                'usetrash' => MyTrainingRundown::hasSoftDeleted(),
            ]
        ];
    }
}
