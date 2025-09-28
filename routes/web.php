<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\XrateController;

Route::get('/', [XrateController::class, 'index']);
