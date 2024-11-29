<?php

namespace Module\MyTraining\Http\Resources;

use Module\MyTraining\Models\MyTrainingQuestion;
use Illuminate\Http\Resources\Json\ResourceCollection;

class QuestionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return QuestionResource::collection($this->collection);
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
                'combos' => MyTrainingQuestion::mapCombos($request),

                /** the page data filter */
                'filters' => MyTrainingQuestion::mapFilters(),

                /** the table header */
                'headers' => MyTrainingQuestion::mapHeaders($request),

                /** the page icon */
                'icon' => MyTrainingQuestion::getPageIcon('mytraining-question'),

                /** the record key */
                'key' => MyTrainingQuestion::getDataKey(),

                /** the page default */
                'recordBase' => MyTrainingQuestion::mapRecordBase($request),

                /** the page statuses */
                'statuses' => MyTrainingQuestion::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => MyTrainingQuestion::getPageTitle($request, 'mytraining-question'),

                /** the usetrash flag */
                'usetrash' => MyTrainingQuestion::hasSoftDeleted(),
            ]
        ];
    }
}
