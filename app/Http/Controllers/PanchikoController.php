<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use App\Models\Panchiko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class PanchikoController extends Controller
{
    public function getPanchikos()
    {
        $panchikos = Panchiko::all();
        return view('panchiko.index', compact('panchikos'));
    }
    public function getMachineOfPanchiko($panchiko_id)
    {
        $panchiko = Panchiko::find($panchiko_id);
        if (!$panchiko) {
            abort(404);
        }
        $machines = Machine::where('panchiko_id', $panchiko_id)->orderBy('created_at', 'desc')->get();
        return view('machine.index', compact('panchiko', 'machines'));
    }

    public function getChartOfMachine(Request $request)
    {
        $machine = Machine::findOrFail($request->machine_id)->load('machineCharts');
        
        return view('machine.chart', compact( 'machine'));

    }
    public function getData(Request $request)
    {
        
        // Artisan::call('')
    }
}
