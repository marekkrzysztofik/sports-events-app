<?php

namespace App\Repositories;

use App\Models\Discipline;
use Illuminate\Database\Eloquent\Collection;

class DisciplineRepository
{
    public function getDisc(): Collection 
    {
        return Discipline::all(); 
    } 
    
    public function editDisc($id)
    {
        return Discipline::find($id);
    }
}  