<?php

namespace App\Services;

use App\Models\Discipline;
use Illuminate\Http\Request;

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
    }
    public function deleteDisc($id)
    {
        $discipline = Discipline::findOrFail($id);
        $discipline->delete();
    }
    public function updateDisc(Request $request, $id)
    {
        $discipline = Discipline::find($id);
        $discipline->name = $request['name'];
        $discipline->style = $request['style'];
        $discipline->competition = $request['competition'];
        $discipline->ageGroup = $request['ageGroup'];
        $discipline->startTime = $request['startTime'];
        $discipline->sex = $request['sex'];
        $discipline->participants = $request['participants'];
        $discipline->timeNotScore = $request['timeNotScore'];
        $discipline->bigScoreWins = $request['bigScoreWins'];
        $discipline->save();
    }

    public function createOrUpdateDiscipline(Request $request)
    {
        $data = $request->all();
        if (array_key_exists("id", $data) && $data['id']) {
            $this->updateDisc($request, $data["id"]);
        } else {
            $this->createDiscipline($request);
        }
    }
}
