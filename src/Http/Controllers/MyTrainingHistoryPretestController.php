<?php

namespace Module\MyTraining\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\MyTraining\Models\MyTrainingQuestion;
use Module\MyTraining\Models\MyTrainingEvent;
use Module\MyTraining\Http\Resources\QuestionCollection;
use Module\MyTraining\Http\Resources\QuestionShowResource;

class MyTrainingHistoryPretestController extends Controller
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

        return new QuestionCollection(
            $myTrainingEvent
                ->questions()
                ->applyMode($request->mode)
                ->filter($request->filters)
                ->search($request->findBy)
                ->sortBy($request->sortBy, $request->sortDesc)
                ->paginate($request->itemsPerPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\MyTraining\Models\MyTrainingEvent $myTrainingEvent
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, MyTrainingEvent $myTrainingEvent)
    {
        Gate::authorize('create', MyTrainingQuestion::class);

        $request->validate([]);

        return MyTrainingQuestion::storeRecord($request, $myTrainingEvent);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\MyTraining\Models\MyTrainingEvent $myTrainingEvent
     * @param  \Module\MyTraining\Models\MyTrainingQuestion $myTrainingQuestion
     * @return \Illuminate\Http\Response
     */
    public function show(MyTrainingEvent $myTrainingEvent, MyTrainingQuestion $myTrainingQuestion)
    {
        Gate::authorize('show', $myTrainingQuestion);

        return new QuestionShowResource($myTrainingQuestion);
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

        $request->validate([]);

        return MyTrainingQuestion::updateRecord($request, $myTrainingQuestion);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\MyTraining\Models\MyTrainingEvent $myTrainingEvent
     * @param  \Module\MyTraining\Models\MyTrainingQuestion $myTrainingQuestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(MyTrainingEvent $myTrainingEvent, MyTrainingQuestion $myTrainingQuestion)
    {
        Gate::authorize('delete', $myTrainingQuestion);

        return MyTrainingQuestion::deleteRecord($myTrainingQuestion);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\MyTraining\Models\MyTrainingQuestion $myTrainingQuestion
     * @return \Illuminate\Http\Response
     */
    public function restore(MyTrainingEvent $myTrainingEvent, MyTrainingQuestion $myTrainingQuestion)
    {
        Gate::authorize('restore', $myTrainingQuestion);

        return MyTrainingQuestion::restoreRecord($myTrainingQuestion);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\MyTraining\Models\MyTrainingQuestion $myTrainingQuestion
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(MyTrainingEvent $myTrainingEvent, MyTrainingQuestion $myTrainingQuestion)
    {
        Gate::authorize('destroy', $myTrainingQuestion);

        return MyTrainingQuestion::destroyRecord($myTrainingQuestion);
    }
}