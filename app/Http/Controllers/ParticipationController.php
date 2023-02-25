<?php

namespace App\Http\Controllers;
use App\Repositories\ParticipationRepository;
use App\Services\ParticipationService;
use App\Models\Participation;
use Illuminate\Http\Request;
use App\Models\Discipline;
use App\Models\Sportsman;

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
    public function getParticipationByComp($id)
    {
        return ($this->participationRepository->getParticipationByComp($id));
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
}
