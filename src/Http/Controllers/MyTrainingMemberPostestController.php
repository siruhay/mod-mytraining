<?php

namespace Module\MyTraining\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\MyTraining\Models\MyTrainingEvent;
use Module\MyTraining\Models\MyTrainingPostest;
use Module\MyTraining\Http\Resources\PostestCollection;

class MyTrainingMemberPostestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Module\MyTraining\Models\MyTrainingEvent $myTrainingEvent
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, MyTrainingEvent $myTrainingEvent)
    {
        Gate::authorize('view', MyTrainingPostest::class);

        return response()->json([
            'data' => new PostestCollection($myTrainingEvent->questions()->where('mode', 'POSTEST')->get()),
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
     * @param  \Module\MyTraining\Models\MyTrainingPostest $myTrainingPostest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MyTrainingEvent $myTrainingEvent, MyTrainingPostest $myTrainingPostest)
    {
        Gate::authorize('update', [$myTrainingPostest, $myTrainingEvent]);

        $request->validate([
            'answer' => 'required'
        ]);

        return MyTrainingPostest::updateRecord($request, $myTrainingPostest, $myTrainingEvent);
    }
}
