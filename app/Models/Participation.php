<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participation extends Model
{
    use HasFactory;
    public function disciplines()
    {
        return $this->belongsTo(Discipline::class);
    }

    public function sportsman()
    {
        return $this->belongsTo(Sportsman::class);
    }
}
 