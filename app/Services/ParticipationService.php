<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Participation;
use App\Repositories\ParticipationRepository;

class ParticipationService
{
  protected $participationRepository;

  public function __construct(ParticipationRepository $participationRepository)
  {
    $this->participationRepository = $participationRepository;
  }
  public function getDisciplinesWithSportsman($id)
  {
    return ($this->participationRepository->getDisciplinesWithSportsman($id));
  }
  public function sportsmanWithDiscipline($id)
  {
    return ($this->participationRepository->sportsmanWithDiscipline($id));
  }
  public function getParticipationByCompetitor($id)
  {
    return ($this->participationRepository->getParticipationByCompetitor($id));
  }
  public function participationJoinedWithCompetitors($id)
  {
    return ($this->participationRepository->participationJoinedWithCompetitors($id));
  }
  public function assignSportsman($data)
  {
    $participationArray = $data->all();
    foreach ($participationArray as $participation) {
      $newParticipation = new Participation;
      $newParticipation->discipline_id = $participation['discipline_id'];
      $newParticipation->sportsman_id = $participation['sportsman_id'];
      $newParticipation->time = $participation['time'];
      $newParticipation->score = $participation['score'];
      $this->participationRepository->save($newParticipation);
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
      $this->participationRepository->update($participationWithScores);
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
    $this->participationRepository->delete($id);
  }
}
