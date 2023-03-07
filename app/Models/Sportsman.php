<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sportsman extends Model
{
    use HasFactory;
    public function disciplines()
    {
        return $this->belongsToMany(Discipline::class, 'participations');
    }
}
 