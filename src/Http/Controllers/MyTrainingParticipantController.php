<?php

namespace Module\MyTraining\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Module\MyTraining\Models\MyTrainingParticipant;
use Module\MyTraining\Models\MyTrainingEvent;
use Module\MyTraining\Http\Resources\ParticipantCollection;
use Module\MyTraining\Http\Resources\ParticipantShowResource;

class MyTrainingParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Module\MyTraining\Models\MyTrainingEvent $myTrainingEvent
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, MyTrainingEvent $myTrainingEvent)
    {
        Gate::authorize('view', MyTrainingParticipant::class);

        return new ParticipantCollection(
            $myTrainingEvent
                ->participants()
                ->with(['gender', 'subdistrict'])
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
        Gate::authorize('create', MyTrainingParticipant::class);

        $request->validate([]);

        return MyTrainingParticipant::storeRecord($request, $myTrainingEvent);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Module\MyTraining\Models\MyTrainingEvent $myTrainingEvent
     * @param  \Module\MyTraining\Models\MyTrainingParticipant $myTrainingParticipant
     * @return \Illuminate\Http\Response
     */
    public function show(MyTrainingEvent $myTrainingEvent, MyTrainingParticipant $myTrainingParticipant)
    {
        Gate::authorize('show', $myTrainingParticipant);

        return new ParticipantShowResource($myTrainingParticipant);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Module\MyTraining\Models\MyTrainingEvent $myTrainingEvent
     * @param  \Module\MyTraining\Models\MyTrainingParticipant $myTrainingParticipant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MyTrainingEvent $myTrainingEvent, MyTrainingParticipant $myTrainingParticipant)
    {
        Gate::authorize('update', $myTrainingParticipant);

        $request->validate([]);

        return MyTrainingParticipant::updateRecord($request, $myTrainingParticipant);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Module\MyTraining\Models\MyTrainingEvent $myTrainingEvent
     * @param  \Module\MyTraining\Models\MyTrainingParticipant $myTrainingParticipant
     * @return \Illuminate\Http\Response
     */
    public function destroy(MyTrainingEvent $myTrainingEvent, MyTrainingParticipant $myTrainingParticipant)
    {
        Gate::authorize('delete', $myTrainingParticipant);

        return MyTrainingParticipant::deleteRecord($myTrainingParticipant);
    }

    /**
     * Restore the specified resource from soft-delete.
     *
     * @param  \Module\MyTraining\Models\MyTrainingParticipant $myTrainingParticipant
     * @return \Illuminate\Http\Response
     */
    public function restore(MyTrainingEvent $myTrainingEvent, MyTrainingParticipant $myTrainingParticipant)
    {
        Gate::authorize('restore', $myTrainingParticipant);

        return MyTrainingParticipant::restoreRecord($myTrainingParticipant);
    }

    /**
     * Force Delete the specified resource from soft-delete.
     *
     * @param  \Module\MyTraining\Models\MyTrainingParticipant $myTrainingParticipant
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(MyTrainingEvent $myTrainingEvent, MyTrainingParticipant $myTrainingParticipant)
    {
        Gate::authorize('destroy', $myTrainingParticipant);

        return MyTrainingParticipant::destroyRecord($myTrainingParticipant);
    }
}
