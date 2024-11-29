<?php

namespace Module\MyTraining\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\MyTraining\Models\MyTrainingPresence;
use Module\MyTraining\Models\MyTrainingEvent;
use Module\MyTraining\Http\Resources\PresenceCollection;
use Module\MyTraining\Http\Resources\PresenceShowResource;

class MyTrainingPresenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Module\MyTraining\Models\MyTrainingEvent $myTrainingEvent
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, MyTrainingEvent $myTrainingEvent)
    {
        Gate::authorize('view', MyTrainingPresence::class);

        return new PresenceCollection(
            $myTrainingEvent
                ->presences()
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
        Gate::authorize('create', MyTrainingPresence::class);

        $request->validate([]);

        return MyTrainingPresence::storeRecord($request, $myTrainingEvent);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\MyTraining\Models\MyTrainingEvent $myTrainingEvent
     * @param  \Module\MyTraining\Models\MyTrainingPresence $myTrainingPresence
     * @return \Illuminate\Http\Response
     */
    public function show(MyTrainingEvent $myTrainingEvent, MyTrainingPresence $myTrainingPresence)
    {
        Gate::authorize('show', $myTrainingPresence);

        return new PresenceShowResource($myTrainingPresence);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\MyTraining\Models\MyTrainingEvent $myTrainingEvent
     * @param  \Module\MyTraining\Models\MyTrainingPresence $myTrainingPresence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MyTrainingEvent $myTrainingEvent, MyTrainingPresence $myTrainingPresence)
    {
        Gate::authorize('update', $myTrainingPresence);

        $request->validate([]);

        return MyTrainingPresence::updateRecord($request, $myTrainingPresence);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\MyTraining\Models\MyTrainingEvent $myTrainingEvent
     * @param  \Module\MyTraining\Models\MyTrainingPresence $myTrainingPresence
     * @return \Illuminate\Http\Response
     */
    public function destroy(MyTrainingEvent $myTrainingEvent, MyTrainingPresence $myTrainingPresence)
    {
        Gate::authorize('delete', $myTrainingPresence);

        return MyTrainingPresence::deleteRecord($myTrainingPresence);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\MyTraining\Models\MyTrainingPresence $myTrainingPresence
     * @return \Illuminate\Http\Response
     */
    public function restore(MyTrainingEvent $myTrainingEvent, MyTrainingPresence $myTrainingPresence)
    {
        Gate::authorize('restore', $myTrainingPresence);

        return MyTrainingPresence::restoreRecord($myTrainingPresence);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\MyTraining\Models\MyTrainingPresence $myTrainingPresence
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(MyTrainingEvent $myTrainingEvent, MyTrainingPresence $myTrainingPresence)
    {
        Gate::authorize('destroy', $myTrainingPresence);

        return MyTrainingPresence::destroyRecord($myTrainingPresence);
    }
}