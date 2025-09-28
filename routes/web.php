<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\XrateController;

Route::get('/', function () {
    return redirect()->route('xrate.index');
});

Route::name('xrate.')->group(function () {
    Route::get('/xrate', [XrateController::class, 'index'])->name('index');
    Route::get('/xrate/result', [XrateController::class, 'result'])->name('result');
    Route::get('/rates', [XrateController::class, 'rates'])->name('rates');
});
