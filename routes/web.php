<?php

use App\Http\Controllers\PanchikoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/panchikos/', [PanchikoController::class, 'getPanchikos'])->name('panchikos');
Route::get('/panchikos/{panchiko_id}/machines/', [PanchikoController::class, 'getMachineOfPanchiko'])->name('machines');
Route::get('/panchikos/{panchiko_id}/machines/{machine_id}', [PanchikoController::class, 'getChartOfMachine'])->name('machine.chart');