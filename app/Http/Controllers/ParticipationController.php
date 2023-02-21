<?php

namespace App\Http\Controllers;

use App\Models\Participation;
use Illuminate\Http\Request;

class ParticipationController extends Controller
{

    public function assignSportsman(Request $data)
    {
        $participation = new Participation;
        $participation->discipline_id = $data['discipline_id'];
        $participation->sportsman_id = $data['sportsman_id'];
        $participation->score = $data['score'];
    }
    public function getParticipations() {
         return Participation::all(); 
    }

}
