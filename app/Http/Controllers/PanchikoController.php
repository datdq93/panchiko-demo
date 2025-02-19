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
        set_time_limit(300);
        $link = $request->link;
        if(!$link)
        {
            return redirect()->back();
        }

        try {
            Artisan::call('app:craw-data', [
                'panchiko_id' => $link,
                'type' => 'link'
                ]);
        } catch (\Throwable $th) {
           dd($th);
        }

    
        return redirect()->route('panchikos');


    }
}
