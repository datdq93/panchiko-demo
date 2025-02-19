<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Machine extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'panchiko_id',
        'name',
        'title_filter_url'
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    public function panchiko()
    {
        return $this->belongsTo(Panchiko::class);
    }
    public function machineCharts()
    {
        return $this->hasMany(MachineChart::class);
    }
}
