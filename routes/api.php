<?php

use Illuminate\Support\Facades\Route;
use Module\MyTraining\Http\Controllers\DashboardController;
use Module\MyTraining\Http\Controllers\MyTrainingEventController;
use Module\MyTraining\Http\Controllers\MyTrainingHistoryController;
use Module\MyTraining\Http\Controllers\MyTrainingPostestController;
use Module\MyTraining\Http\Controllers\MyTrainingPretestController;
use Module\MyTraining\Http\Controllers\MyTrainingRundownController;
use Module\MyTraining\Http\Controllers\MyTrainingPresenceController;
use Module\MyTraining\Http\Controllers\MyTrainingParticipantController;
use Module\MyTraining\Http\Controllers\MyTrainingMemberPostestController;
use Module\MyTraining\Http\Controllers\MyTrainingMemberPretestController;
use Module\MyTraining\Http\Controllers\MyTrainingHistoryPostestController;
use Module\MyTraining\Http\Controllers\MyTrainingHistoryPretestController;
use Module\MyTraining\Http\Controllers\MyTrainingHistoryRundownController;
use Module\MyTraining\Http\Controllers\MyTrainingHistoryPresenceController;
use Module\MyTraining\Http\Controllers\MyTrainingHistoryParticipantController;

Route::get('dashboard', [DashboardController::class, 'index']);
Route::get('report', [DashboardController::class, 'report']);

Route::post('event/{myTrainingEvent}/presence', [MyTrainingEventController::class, 'presence']);
Route::resource('event', MyTrainingEventController::class)
    ->parameters(['event' => 'myTrainingEvent']);

Route::resource('event.participant', MyTrainingParticipantController::class)
    ->parameters([
        'event' => 'myTrainingEvent',
        'participant' => 'myTrainingParticipant'
    ]);

Route::post('rundown/{myTrainingRundown}/upload', [MyTrainingRundownController::class, 'upload']);
Route::resource('event.rundown', MyTrainingRundownController::class)
    ->parameters([
        'event' => 'myTrainingEvent',
        'rundown' => 'myTrainingRundown'
    ]);

Route::resource('event.pretest', MyTrainingPretestController::class)
    ->parameters([
        'event' => 'myTrainingEvent',
        'pretest' => 'myTrainingQuestion'
    ]);

Route::resource('event.postest', MyTrainingPostestController::class)
    ->parameters([
        'event' => 'myTrainingEvent',
        'postest' => 'myTrainingQuestion'
    ]);

Route::resource('event.member-pretest', MyTrainingMemberPretestController::class)
    ->parameters([
        'event' => 'myTrainingEvent',
        'member-pretest' => 'myTrainingQuestion'
    ]);

Route::resource('event.member-postest', MyTrainingMemberPostestController::class)
    ->parameters([
        'event' => 'myTrainingEvent',
        'member-postest' => 'myTrainingQuestion'
    ]);

Route::resource('history', MyTrainingHistoryController::class)
    ->parameters(['history' => 'myTrainingHistoryEvent']);

Route::resource('history.participant', MyTrainingHistoryParticipantController::class)
    ->parameters([
        'history' => 'myTrainingHistoryEvent',
        'participant' => 'myTrainingParticipant'
    ]);

Route::resource('history.rundown', MyTrainingHistoryRundownController::class)
    ->parameters([
        'history' => 'myTrainingHistoryEvent',
        'rundown' => 'myTrainingRundown'
    ]);

Route::resource('history.pretest', MyTrainingHistoryPretestController::class)
    ->parameters([
        'history' => 'myTrainingHistoryEvent',
        'pretest' => 'myTrainingQuestion'
    ]);

Route::resource('history.postest', MyTrainingHistoryPostestController::class)
    ->parameters([
        'history' => 'myTrainingHistoryEvent',
        'postest' => 'myTrainingQuestion'
    ]);

Route::resource('history.presence', MyTrainingHistoryPresenceController::class)
    ->parameters([
        'history' => 'myTrainingHistoryEvent',
        'presence' => 'myTrainingPresence'
    ]);
