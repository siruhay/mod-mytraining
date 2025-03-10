<?php

namespace Module\MyTraining\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\MyTraining\Models\MyTrainingAnswer;
use Module\MyTraining\Http\Resources\AnswerCollection;
use Module\MyTraining\Http\Resources\AnswerShowResource;

class MyTrainingAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('view', MyTrainingAnswer::class);

        return new AnswerCollection(
            MyTrainingAnswer::applyMode($request->mode)
                ->filter($request->filters)
                ->search($request->findBy)
                ->sortBy($request->sortBy)
                ->paginate($request->itemsPerPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('create', MyTrainingAnswer::class);

        $request->validate([]);

        return MyTrainingAnswer::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\MyTraining\Models\MyTrainingAnswer $myTrainingAnswer
     * @return \Illuminate\Http\Response
     */
    public function show(MyTrainingAnswer $myTrainingAnswer)
    {
        Gate::authorize('show', $myTrainingAnswer);

        return new AnswerShowResource($myTrainingAnswer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\MyTraining\Models\MyTrainingAnswer $myTrainingAnswer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MyTrainingAnswer $myTrainingAnswer)
    {
        Gate::authorize('update', $myTrainingAnswer);

        $request->validate([]);

        return MyTrainingAnswer::updateRecord($request, $myTrainingAnswer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\MyTraining\Models\MyTrainingAnswer $myTrainingAnswer
     * @return \Illuminate\Http\Response
     */
    public function destroy(MyTrainingAnswer $myTrainingAnswer)
    {
        Gate::authorize('delete', $myTrainingAnswer);

        return MyTrainingAnswer::deleteRecord($myTrainingAnswer);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\MyTraining\Models\MyTrainingAnswer $myTrainingAnswer
     * @return \Illuminate\Http\Response
     */
    public function restore(MyTrainingAnswer $myTrainingAnswer)
    {
        Gate::authorize('restore', $myTrainingAnswer);

        return MyTrainingAnswer::restoreRecord($myTrainingAnswer);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\MyTraining\Models\MyTrainingAnswer $myTrainingAnswer
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(MyTrainingAnswer $myTrainingAnswer)
    {
        Gate::authorize('destroy', $myTrainingAnswer);

        return MyTrainingAnswer::destroyRecord($myTrainingAnswer);
    }
}
