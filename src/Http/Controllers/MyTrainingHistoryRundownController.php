<?php

namespace Module\MyTraining\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\MyTraining\Models\MyTrainingRundown;
use Module\MyTraining\Models\MyTrainingEvent;
use Module\MyTraining\Http\Resources\RundownCollection;
use Module\MyTraining\Http\Resources\RundownShowResource;

class MyTrainingHistoryRundownController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Module\MyTraining\Models\MyTrainingEvent $myTrainingEvent
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, MyTrainingEvent $myTrainingEvent)
    {
        Gate::authorize('view', MyTrainingRundown::class);

        return new RundownCollection(
            $myTrainingEvent
                ->rundowns()
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
        Gate::authorize('create', MyTrainingRundown::class);

        $request->validate([]);

        return MyTrainingRundown::storeRecord($request, $myTrainingEvent);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\MyTraining\Models\MyTrainingEvent $myTrainingEvent
     * @param  \Module\MyTraining\Models\MyTrainingRundown $myTrainingRundown
     * @return \Illuminate\Http\Response
     */
    public function show(MyTrainingEvent $myTrainingEvent, MyTrainingRundown $myTrainingRundown)
    {
        Gate::authorize('show', $myTrainingRundown);

        return new RundownShowResource($myTrainingRundown);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\MyTraining\Models\MyTrainingEvent $myTrainingEvent
     * @param  \Module\MyTraining\Models\MyTrainingRundown $myTrainingRundown
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MyTrainingEvent $myTrainingEvent, MyTrainingRundown $myTrainingRundown)
    {
        Gate::authorize('update', $myTrainingRundown);

        $request->validate([]);

        return MyTrainingRundown::updateRecord($request, $myTrainingRundown);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\MyTraining\Models\MyTrainingEvent $myTrainingEvent
     * @param  \Module\MyTraining\Models\MyTrainingRundown $myTrainingRundown
     * @return \Illuminate\Http\Response
     */
    public function destroy(MyTrainingEvent $myTrainingEvent, MyTrainingRundown $myTrainingRundown)
    {
        Gate::authorize('delete', $myTrainingRundown);

        return MyTrainingRundown::deleteRecord($myTrainingRundown);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\MyTraining\Models\MyTrainingRundown $myTrainingRundown
     * @return \Illuminate\Http\Response
     */
    public function restore(MyTrainingEvent $myTrainingEvent, MyTrainingRundown $myTrainingRundown)
    {
        Gate::authorize('restore', $myTrainingRundown);

        return MyTrainingRundown::restoreRecord($myTrainingRundown);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\MyTraining\Models\MyTrainingRundown $myTrainingRundown
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(MyTrainingEvent $myTrainingEvent, MyTrainingRundown $myTrainingRundown)
    {
        Gate::authorize('destroy', $myTrainingRundown);

        return MyTrainingRundown::destroyRecord($myTrainingRundown);
    }
}