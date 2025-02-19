<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use App\Models\Panchiko;
use Illuminate\Http\Request;

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
}
