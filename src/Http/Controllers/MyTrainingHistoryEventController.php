<?php

namespace Module\MyTraining\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\MyTraining\Models\MyTrainingHistoryEvent;
use Module\MyTraining\Http\Resources\HistoryEventCollection;
use Module\MyTraining\Http\Resources\HistoryEventShowResource;

class MyTrainingHistoryEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('view', MyTrainingHistoryEvent::class);

        return new HistoryEventCollection(
            MyTrainingHistoryEvent::applyMode($request->mode)
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
        Gate::authorize('create', MyTrainingHistoryEvent::class);

        $request->validate([]);

        return MyTrainingHistoryEvent::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\MyTraining\Models\MyTrainingHistoryEvent $myTrainingHistoryEvent
     * @return \Illuminate\Http\Response
     */
    public function show(MyTrainingHistoryEvent $myTrainingHistoryEvent)
    {
        Gate::authorize('show', $myTrainingHistoryEvent);

        return new HistoryEventShowResource($myTrainingHistoryEvent);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\MyTraining\Models\MyTrainingHistoryEvent $myTrainingHistoryEvent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MyTrainingHistoryEvent $myTrainingHistoryEvent)
    {
        Gate::authorize('update', $myTrainingHistoryEvent);

        $request->validate([]);

        return MyTrainingHistoryEvent::updateRecord($request, $myTrainingHistoryEvent);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\MyTraining\Models\MyTrainingHistoryEvent $myTrainingHistoryEvent
     * @return \Illuminate\Http\Response
     */
    public function destroy(MyTrainingHistoryEvent $myTrainingHistoryEvent)
    {
        Gate::authorize('delete', $myTrainingHistoryEvent);

        return MyTrainingHistoryEvent::deleteRecord($myTrainingHistoryEvent);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\MyTraining\Models\MyTrainingHistoryEvent $myTrainingHistoryEvent
     * @return \Illuminate\Http\Response
     */
    public function restore(MyTrainingHistoryEvent $myTrainingHistoryEvent)
    {
        Gate::authorize('restore', $myTrainingHistoryEvent);

        return MyTrainingHistoryEvent::restoreRecord($myTrainingHistoryEvent);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\MyTraining\Models\MyTrainingHistoryEvent $myTrainingHistoryEvent
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(MyTrainingHistoryEvent $myTrainingHistoryEvent)
    {
        Gate::authorize('destroy', $myTrainingHistoryEvent);

        return MyTrainingHistoryEvent::destroyRecord($myTrainingHistoryEvent);
    }
}
