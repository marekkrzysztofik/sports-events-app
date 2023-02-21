<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{   
    use HasFactory;
    public function sportsman()
    {
        return $this->belongsToMany(Sportsman::class, 'participations');
    }
}
 