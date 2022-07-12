<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\FillDataController;
use App\Http\Controllers\SummaryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('countries', [CountryController::class, 'index'])->name('countries.index');
Route::get('countries/summary', SummaryController::class)->name('countries.summary');

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/fill_data', FillDataController::class);

    Route::post('countries', [CountryController::class, 'store'])->name('countries.store');
    Route::get('countries/{country}', [CountryController::class, 'show'])->name('countries.show');
    Route::patch('countries/{country}', [CountryController::class, 'update'])->name('countries.update');
});
