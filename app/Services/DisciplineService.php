<?php
 
namespace App\Services;

use App\Models\Discipline;

class DisciplineService
{
    public function createDiscipline($data)
    {
        $discipline = new Discipline;
        $discipline->name = $data['name'];
        $discipline->style = $data['style'];
        $discipline->competition = $data['competition'];
        $discipline->ageGroup = $data['ageGroup'];
        $discipline->startTime = $data['startTime'];
        $discipline->sex = $data['sex'];
        $discipline->participants = $data['participants'];
        $discipline->timeNotScore = $data['timeNotScore'];
        $discipline->bigScoreWins = $data['bigScoreWins'];
        $discipline->save();
        return $discipline;
    }
    public function deleteDisc($id)
    {
        $discipline = Discipline::findOrFail($id);
        $discipline->delete();
    }
}
