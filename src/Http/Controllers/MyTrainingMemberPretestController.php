<?php

namespace Module\MyTraining\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\MyTraining\Models\MyTrainingEvent;
use Module\MyTraining\Models\MyTrainingPretest;
use Module\MyTraining\Http\Resources\PretestCollection;

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
        Gate::authorize('view', MyTrainingPretest::class);

        return response()->json([
            'data' => new PretestCollection($myTrainingEvent->questions()->where('mode', 'PRETEST')->get()),
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
     * @param  \Module\MyTraining\Models\MyTrainingPretest $myTrainingPretest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MyTrainingEvent $myTrainingEvent, MyTrainingPretest $myTrainingPretest)
    {
        Gate::authorize('update', $myTrainingPretest);

        $request->validate([
            'answer' => 'required'
        ]);

        return MyTrainingPretest::updateRecord($request, $myTrainingPretest, $myTrainingEvent);
    }
}
