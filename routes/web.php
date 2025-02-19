<?php

use App\Http\Controllers\PanchikoController;
use Illuminate\Support\Facades\Route;


Route::get('/', [PanchikoController::class, 'getPanchikos'])->name('panchikos');
Route::post('/get-data', [PanchikoController::class, 'getData'])->name('get_data');
Route::get('/panchikos/{panchiko_id}/machines/', [PanchikoController::class, 'getMachineOfPanchiko'])->name('machines');
Route::get('/panchikos/{panchiko_id}/machines/{machine_id}', [PanchikoController::class, 'getChartOfMachine'])->name('machine.chart');
