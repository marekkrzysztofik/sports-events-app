<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\DisciplineRepository;
use App\Services\DisciplineService;
use App\Models\Discipline; 

class DisciplineController extends Controller
{
    private DisciplineRepository $disciplineRepository;
    private DisciplineService $disciplineService;

    public function __construct(DisciplineRepository $disciplineRepository, DisciplineService $disciplineService)
    {
        $this->disciplineRepository = $disciplineRepository;
        $this->disciplineService = $disciplineService;
    }

    public function getDisc()
    {
        return ($this->disciplineRepository->getDisc()->all());
    }
    public function deleteDisc($id)
    {
        return ($this->disciplineService->deleteDisc($id));
    }

    public function editDisc($id)
    {
        return ($this->disciplineRepository->editDisc($id));
    }

    public function createOrUpdateDiscipline(Request $data)
    {
        return ($this->disciplineService->createOrUpdateDiscipline($data));
    }
}
