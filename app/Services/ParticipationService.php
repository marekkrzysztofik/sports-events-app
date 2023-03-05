<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Participation;

class ParticipationService
{
  public function assignSportsman($data)
  {
    $participationArray = $data->all();
    foreach ($participationArray as $participation) {
      $newParticipation = new Participation;
      $newParticipation->discipline_id = $participation['discipline_id'];
      $newParticipation->sportsman_id = $participation['sportsman_id'];
      $newParticipation->time = $participation['time'];
      $newParticipation->score = $participation['score'];
      $newParticipation->save();
    }
  }
  public function saveScore(Request $data)
  {
    $participationArray = $data->all();
    foreach ($participationArray as $participation) {
      $participationWithScores = Participation::find($participation['id']);
      $participationWithScores->discipline_id = $participation['discipline_id'];
      $participationWithScores->sportsman_id = $participation['sportsman_id'];
      $participationWithScores->time = $participation['time'];
      $participationWithScores->score = $participation['score'];
      $participationWithScores->save();
    }
  }
  public function createOrUpdateParticipation(Request $data)
  {
    $participationArray = $data->all();
    if (isset($participationArray[0]['id'])) {
      $this->saveScore($data);
    } else {
      $this->assignSportsman($data);
    }
  }
  public function deleteParticipation($id)
  {
    $participation = Participation::findOrFail($id);
    $participation->delete();
  }
}
