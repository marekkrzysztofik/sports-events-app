<?php

namespace App\Http\Controllers;

use App\Models\Participation;
use Illuminate\Http\Request;
use App\Models\Discipline;
use App\Models\Sportsman;

class ParticipationController extends Controller
{

    public function assignSportsman(Request $data)
    { 
        $participation = new Participation;
        $participation->discipline_id = $data['discipline_id'];
        $participation->sportsman_id = $data['sportsman_id'];
        $participation->score = $data['score'];
        $participation->save();
    }
    public function saveScore(Request $data, $id)
    {
        $participation = Discipline::find($id);
        $participation->discipline_id = $data['discipline_id'];
        $participation->sportsman_id = $data['sportsman_id'];
        $participation->score = $data['score'];
        $participation->save();
    }

    public function createOrUpdateParticipation(Request $request)
    {
        $data = $request->all();
        if (array_key_exists("id", $data) && $data['id']) {
            $this->saveScore($request, $data["id"]);
        } else {
            $this->assignSportsman($request);
        }
    }

    public function getParticipations()
    {
        return Participation::all();
    }
    public function getParticipation($id)
    {
        return Participation::where('discipline_id','=',$id)->get();
    }
    public function discWithSportsman($id)
    {
        $participation = Discipline::with('sportsman')->find($id);
        return $participation;
    }
    public function sportsmanWithDisc($id)
    {
        $participation = Sportsman::with('disciplines')->find($id);
        return $participation;
    }
    public function allDiscWithSportsman()
    {
        $participation = Discipline::with('sportsman')->whereHas('sportsman')->get()->toArray();
        return $participation;
    }
}
