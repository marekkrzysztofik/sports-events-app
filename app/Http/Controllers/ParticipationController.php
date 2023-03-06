<?php

namespace App\Http\Controllers;

use App\Services\ParticipationService;
use Illuminate\Http\Request;

class ParticipationController extends Controller
{
    private ParticipationService $participationService;

    public function __construct(ParticipationService $participationService)
    {
        $this->participationService = $participationService;
    }
    public function createOrUpdateParticipation(Request $data)
    {
        return ($this->participationService->createOrUpdateParticipation($data));
    }
    public function getParticipationByCompetitor($id)
    {
        return ($this->participationService->getParticipationByCompetitor($id));
    }
    public function deleteParticipation($id)
    {
        return ($this->participationService->deleteParticipation($id));
    }

    public function getDisciplinesWithSportsman($id)
    {
        return ($this->participationService->getDisciplinesWithSportsman($id));
    }
    public function sportsmanWithDiscipline($id)
    {
        return ($this->participationService->sportsmanWithDiscipline($id));
    }
    public function participationJoinedWithCompetitors($id)
    {
        return ($this->participationService->participationJoinedWithCompetitors($id));
    }
}
