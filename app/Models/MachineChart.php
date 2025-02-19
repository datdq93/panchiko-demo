<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class MachineChart extends Model
{
    use HasFactory;
    protected $fillable = [
        'machine_id',
        'chart_name',
        'chart_data',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }
}
