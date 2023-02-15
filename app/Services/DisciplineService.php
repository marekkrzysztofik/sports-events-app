<?php

namespace App\Services;

use App\Models\Discipline;

class DisciplineService
{
    public function createDiscipline($data)
    {
        $discipline = new Discipline;
        $discipline->name = $data['name'];
        $discipline->category = $data['category'];
        $discipline->ageGroup = $data['ageGroup'];
        $discipline->startTime = $data['startTime'];
        $discipline->sex = $data['sex'];
        $discipline->participants = $data['participants']; 
        $discipline->save();
        return $discipline;
    }
    public function deleteDisc($id)
    {
        $discipline = Discipline::findOrFail($id);
        $discipline->delete();
    }
}
