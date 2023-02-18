<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SportsmanRepository;
use App\Services\SportsmanService;

class SportsmanController extends Controller
{
    private SportsmanRepository $sportsmanRepository;
    private SportsmanService $sportsmanService;

    public function __construct(SportsmanRepository $sportsmanRepository, SportsmanService $sportsmanService)
    {
        $this->sportsmanRepository = $sportsmanRepository;
        $this->sportsmanService = $sportsmanService;
    }

    public function createSportsman(Request $request)
    {
        $data = $request->all();
        $this->sportsmanService->createSportsman($data);
    }
    public function getSportsman()
    {
        return ($this->sportsmanRepository->getSportsman()->all());
    }
    public function deleteSportsman($id)
    {
        return ($this->sportsmanService->deleteSportsman($id));
    }
    public function editSportsman($id)
    {
        return ($this->sportsmanRepository->editSportsman($id));
    }

}
