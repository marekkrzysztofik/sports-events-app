<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Participation;

class ParticipationService
{
  public function assignSportsman($data)
  {
    $participation = new Participation;
    $participation->discipline_id = $data['discipline_id'];
    $participation->sportsman_id = $data['sportsman_id'];
    $participation->score = $data['score'];
    $participation->time = $data['time'];
    $participation->save();
  }
  public function saveScore(Request $data, $id)
  {
    $participation = Participation::find($id);
    $participation->discipline_id = $data['discipline_id'];
    $participation->sportsman_id = $data['sportsman_id'];
    $participation->score = $data['score'];
    $participation->time = $data['time'];
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
  public function deleteParticipation($id) 
    {
        $participation = Participation::findOrFail($id);
        $participation->delete();
    }
}  
