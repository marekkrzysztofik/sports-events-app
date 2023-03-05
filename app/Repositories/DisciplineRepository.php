<?php

namespace App\Repositories;

use App\Models\Discipline;
use Illuminate\Database\Eloquent\Collection;

class DisciplineRepository
{
    protected $discipline;
    public function __construct()
    {
        //$this->discipline = $discipline;
        $this->discipline = new Discipline();
    }

    public function save($discipline)
    {
        $discipline->save();
    }

    public function getDisciplines()
    {
        return $this->discipline
            ->get();
    }
    public function delete($id)
    {
        $discipline = Discipline::findOrFail($id);
        $discipline->delete();
    }
    public function update($discipline)
    {
        $discipline->update();
    }
    public function getDisciplineById($id)
    {
        return $this->discipline->find($id);
    }
    public function getDisciplinesByUserId($id)
    {
        return $this->discipline->where('user_id', '=', $id)->get();
    }
}
