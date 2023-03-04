<?php

namespace App\Repositories;

use App\Models\Discipline;
use Illuminate\Database\Eloquent\Collection; 

class DisciplineRepository
{
    public function getDisciplines(): Collection 
    {
        return Discipline::all(); 
    }  
    
    public function getDiscipline($id)
    {
        return Discipline::find($id);
    }
    public function getDisciplinesByUserId($id)
    {
      return Discipline::where('user_id', '=', $id)->get();
    }
}  