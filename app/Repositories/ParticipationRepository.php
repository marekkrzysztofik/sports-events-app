<?php

namespace App\Repositories;

use App\Models\Participation;
use Illuminate\Support\Facades\DB;
use App\Models\Discipline;
use App\Models\Sportsman;

class ParticipationRepository
{
  protected $sportsman;
  protected $discipline;
  protected $participation;
  public function __construct()
  {
    $this->discipline = new Discipline();
    $this->sportsman = new Sportsman();
    $this->participation = new Participation();
  }
  public function save($participation)
  {
    $participation->save();
  }
  public function update($participation)
  {
    $participation->update();
  }
  public function delete($id)
  {
    $participation = $this->participation->findOrFail($id);
    $participation->delete();
  }
  public function getParticipationByCompetitor($id)
  {
    return $this->participation->where('sportsman_id', '=', $id)->get();
  }
  public function getDisciplinesWithSportsman($id)
  {
    return $this->discipline->with('sportsman')->find($id);
  }
  public function sportsmanWithDiscipline($id)
  {
    return $this->sportsman->with('disciplines')->find($id);
  }
  public function participationJoinedWithCompetitors($id)
  {
    $joinedTables = DB::table('sportsmen')
      ->join('participations', 'sportsmen.id', '=', 'participations.sportsman_id')->where('discipline_id', '=', $id)->get();
    return $joinedTables;
  }
}
