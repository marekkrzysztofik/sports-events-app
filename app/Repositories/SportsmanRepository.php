<?php

namespace App\Repositories;

use App\Models\Sportsman;

class SportsmanRepository
{
    protected $sportsman;
    public function __construct()
    {
        $this->sportsman = new Sportsman();
    }
    public function getSportsmanById($id)
    {
        return $this->sportsman->find($id);
    }
    public function save($sportsman)
    {
        $sportsman->save();
    }
    public function getSportsmenByUserId($id)
    {
        return $this->sportsman->where('user_id', '=', $id)->get();
    }
    public function delete($id)
    {
        $sportsman = $this->sportsman->findOrFail($id);
        $sportsman->delete();
    }
    public function update($sportsman)
    {
        $sportsman->update();
    }
    public function getSportsman()
    {
        return $this->sportsman
            ->get();
    }
}
