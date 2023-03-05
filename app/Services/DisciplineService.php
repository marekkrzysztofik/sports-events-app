<?php

namespace App\Services;

use App\Repositories\DisciplineRepository;
use App\Models\Discipline;
use Illuminate\Http\Request;

class DisciplineService
{
    protected $disciplineRepository;

    public function __construct(DisciplineRepository $disciplineRepository)
    {
        $this->disciplineRepository = $disciplineRepository;
    }
    public function getDisciplinesByUserId($id)
    {
        return $this->disciplineRepository->getDisciplinesByUserId($id);
    }

    public function getDisciplineById($id)
    {
        return $this->disciplineRepository->getDisciplineById($id);
    }
    public function createDiscipline($data)
    {
        $discipline = new Discipline;
        $discipline->name = $data['name'];
        $discipline->user_id = $data['user_id'];
        $discipline->style = $data['style'];
        $discipline->competition = $data['competition'];
        $discipline->minAge = $data['minAge'];
        $discipline->maxAge = $data['maxAge'];
        $discipline->startTime = $data['startTime'];
        $discipline->sex = $data['sex'];
        $discipline->participants = $data['participants'];
        $discipline->timeNotScore = $data['timeNotScore'];
        $discipline->bigScoreWins = $data['bigScoreWins'];
        $this->disciplineRepository->save($discipline);
    }
    public function deleteDiscipline($id)
    {
        $this->disciplineRepository->delete($id);
    }
    public function updateDiscipline($data, $id)
    {
        $discipline = $this->disciplineRepository->getDisciplineById($id);
        $discipline->name = $data['name'];
        $discipline->style = $data['style'];
        $discipline->competition = $data['competition'];
        $discipline->minAge = $data['minAge'];
        $discipline->maxAge = $data['maxAge'];
        $discipline->startTime = $data['startTime'];
        $discipline->sex = $data['sex'];
        $discipline->participants = $data['participants'];
        $discipline->timeNotScore = $data['timeNotScore'];
        $discipline->bigScoreWins = $data['bigScoreWins'];
        $this->disciplineRepository->update($discipline);
    }
}
