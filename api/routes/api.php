<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\FillDataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/fill_data', FillDataController::class);

    Route::post('countries', [CountryController::class, 'store'])->name('countries.store');
    Route::patch('countries/{country}', [CountryController::class, 'update'])->name('countries.update');
});

Route::get('countries', [CountryController::class, 'index'])->name('countries.index');
