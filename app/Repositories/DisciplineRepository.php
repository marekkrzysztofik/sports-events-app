<?php

namespace App\Repositories;

use App\Models\Discipline;

class DisciplineRepository
{
    protected $discipline;
    public function __construct() 
    {
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
        $discipline = $this->discipline->findOrFail($id);
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
