<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Repositories\ParticipationRepository;
use App\Services\ParticipationService;
use Illuminate\Http\Request;

class ParticipationController extends Controller
{
    private ParticipationRepository $participationRepository;
    private ParticipationService $participationService;

    public function __construct(ParticipationRepository $participationRepository, ParticipationService $participationService)
    {
        $this->participationRepository = $participationRepository;
        $this->participationService = $participationService;
    }
    public function getParticipations()
    {
        return ($this->participationRepository->getParticipations()->all());
    }
    public function createOrUpdateParticipation(Request $data)
    {
        return ($this->participationService->createOrUpdateParticipation($data));
    }
    public function getParticipationByComp($id)
    {
        return ($this->participationRepository->getParticipationByComp($id));
    }
    public function deleteParticipation($id)
    {
        return ($this->participationService->deleteParticipation($id));
    }
    public function getParticipationByDisc($id)
    {
        return ($this->participationRepository->getParticipationByDisc($id));
    }
    public function discWithSportsman($id)
    {
        return ($this->participationRepository->discWithSportsman($id));
    }
    public function sportsmanWithDisc($id)
    {
        return ($this->participationRepository->sportsmanWithDisc($id));
    }
    public function allDiscWithSportsman($id)
    {
        return ($this->participationRepository->allDiscWithSportsman($id));
    }
    public function participationJoinedWithCompetitors($id)
    {
        $joinedTables = DB::table('sportsmen')
            ->join('participations', 'sportsmen.id', '=', 'participations.sportsman_id')->where('discipline_id', '=', $id)->get();
        return $joinedTables;
    }
}
