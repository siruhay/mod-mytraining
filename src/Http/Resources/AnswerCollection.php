<?php

namespace Module\MyTraining\Http\Resources;

use Module\MyTraining\Models\MyTrainingAnswer;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AnswerCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return AnswerResource::collection($this->collection);
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
                'combos' => MyTrainingAnswer::mapCombos($request),

                /** the page data filter */
                'filters' => MyTrainingAnswer::mapFilters(),

                /** the table header */
                'headers' => MyTrainingAnswer::mapHeaders($request),

                /** the page icon */
                'icon' => MyTrainingAnswer::getPageIcon('mytraining-answer'),

                /** the record key */
                'key' => MyTrainingAnswer::getDataKey(),

                /** the page default */
                'recordBase' => MyTrainingAnswer::mapRecordBase($request),

                /** the page statuses */
                'statuses' => MyTrainingAnswer::mapStatuses($request),

                /** the page data mode */
                'trashed' => $request->trashed ?: false,

                /** the page title */
                'title' => MyTrainingAnswer::getPageTitle($request, 'mytraining-answer'),

                /** the usetrash flag */
                'usetrash' => MyTrainingAnswer::hasSoftDeleted(),
            ]
        ];
    }
}
