<?php

namespace Module\MyTraining\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\MyTraining\Models\MyTrainingEvent;
use Module\MyTraining\Models\MyTrainingQuestion;
use Module\MyTraining\Http\Resources\QuestionMapCollection;

class MyTrainingMemberPretestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Module\MyTraining\Models\MyTrainingEvent $myTrainingEvent
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, MyTrainingEvent $myTrainingEvent)
    {
        Gate::authorize('view', MyTrainingQuestion::class);

        return response()->json([
            'data' => new QuestionMapCollection($myTrainingEvent->questions()->where('mode', 'PRETEST')->get()),
            'setups'  => [
                'statuses' => [
                    'isCompleted' => $myTrainingEvent->questions()->where('mode', 'POSTEST')->count() === $myTrainingEvent->answers()->where('mode', 'POSTEST')->forCurrentUser($request->user())->count()
                ]
            ]
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\MyTraining\Models\MyTrainingEvent $myTrainingEvent
     * @param  \Module\MyTraining\Models\MyTrainingQuestion $myTrainingQuestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MyTrainingEvent $myTrainingEvent, MyTrainingQuestion $myTrainingQuestion)
    {
        Gate::authorize('update', $myTrainingQuestion);

        $request->validate([
            'answer' => 'required'
        ]);

        return MyTrainingQuestion::updateRecord($request, $myTrainingQuestion, $myTrainingEvent);
    }
}
