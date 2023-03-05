<?php

namespace App\Repositories;

use App\Models\Participation;
use Illuminate\Http\Request;
use App\Models\Discipline;
use App\Models\Sportsman;
use Illuminate\Database\Eloquent\Collection;

class ParticipationRepository
{
  public function getParticipations(): Collection
  {
    return Participation::all(); 
  }

  public function getParticipationByComp($id)
  {
    return Participation::where('sportsman_id', '=', $id)->get();
  }
  public function getParticipationByDisc($id)
  {
    return Participation::where('discipline_id', '=', $id)->get();
  }
  public function getDisciplinesWithSportsman($id)
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
 