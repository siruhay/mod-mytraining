<?php

namespace Module\MyTraining\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\MyTraining\Models\MyTrainingEvent;
use Module\MyTraining\Http\Resources\EventCollection;
use Module\MyTraining\Http\Resources\EventShowResource;

class MyTrainingEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('view', MyTrainingEvent::class);

        return new EventCollection(
            MyTrainingEvent::onlyActive()
                ->applyMode($request->mode)
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
        Gate::authorize('create', MyTrainingEvent::class);

        $request->validate([]);

        return MyTrainingEvent::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\MyTraining\Models\MyTrainingEvent $myTrainingEvent
     * @return \Illuminate\Http\Response
     */
    public function show(MyTrainingEvent $myTrainingEvent)
    {
        Gate::authorize('show', $myTrainingEvent);

        return new EventShowResource($myTrainingEvent);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\MyTraining\Models\MyTrainingEvent $myTrainingEvent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MyTrainingEvent $myTrainingEvent)
    {
        Gate::authorize('update', $myTrainingEvent);

        $request->validate([]);

        return MyTrainingEvent::updateRecord($request, $myTrainingEvent);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\MyTraining\Models\MyTrainingEvent $myTrainingEvent
     * @return \Illuminate\Http\Response
     */
    public function destroy(MyTrainingEvent $myTrainingEvent)
    {
        Gate::authorize('delete', $myTrainingEvent);

        return MyTrainingEvent::deleteRecord($myTrainingEvent);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\MyTraining\Models\MyTrainingEvent $myTrainingEvent
     * @return \Illuminate\Http\Response
     */
    public function restore(MyTrainingEvent $myTrainingEvent)
    {
        Gate::authorize('restore', $myTrainingEvent);

        return MyTrainingEvent::restoreRecord($myTrainingEvent);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\MyTraining\Models\MyTrainingEvent $myTrainingEvent
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(MyTrainingEvent $myTrainingEvent)
    {
        Gate::authorize('destroy', $myTrainingEvent);

        return MyTrainingEvent::destroyRecord($myTrainingEvent);
    }
}
