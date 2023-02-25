<?php

namespace App\Repositories;
use App\Models\Sportsman;
use Illuminate\Database\Eloquent\Collection;

class SportsmanRepository
{
    public function getSportsman(): Collection
    {
        return Sportsman::all();
    }
    public function editSportsman($id)
    {
        return Sportsman::find($id);
    }
} 