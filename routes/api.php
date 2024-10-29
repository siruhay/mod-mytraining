<?php

use Illuminate\Support\Facades\Route;
use Module\MyTraining\Http\Controllers\DashboardController;


Route::get('dashboard', [DashboardController::class, 'index']);