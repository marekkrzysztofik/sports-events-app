<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SportsmanService;

class SportsmanController extends Controller 
{
    private SportsmanService $sportsmanService;

    public function __construct(SportsmanService $sportsmanService)
    {
        $this->sportsmanService = $sportsmanService;
    }
    public function getSportsmenByUserId($id)
    {
        return $this->sportsmanService->getSportsmenByUserId($id); 
    }
    
    public function deleteSportsman($id)
    {
        return ($this->sportsmanService->deleteSportsman($id));
    }
    public function getSportsmanById($id)
    {
        return ($this->sportsmanService->getSportsmanById($id));
    }

    public function createOrUpdateSportsman(Request $data)
    {
        return ($this->sportsmanService->createOrUpdateSportsman($data));
    }
    
    // public function getSportsman()
    // {
    //     return ($this->sportsmanService->getSportsman()->all());
    // }
}
