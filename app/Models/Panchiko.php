<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Panchiko extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'panchiko_url_id', 'url'];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    public function machines()
    {
        return $this->hasMany(Machine::class, 'panchiko_id');
    }
}
