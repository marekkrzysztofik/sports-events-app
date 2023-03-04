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

    public function getDisciplines()
    {
        return $this->disciplineRepository->getDisciplines()->all(); 
    }
    public function deleteDiscipline($id)
    {
        return $this->disciplineService->deleteDiscipline($id);
    }

    public function getDiscipline($id)
    {
        return $this->disciplineRepository->getDiscipline($id);
    }

    public function createOrUpdateDiscipline(Request $data)
    {
        return $this->disciplineService->createOrUpdateDiscipline($data);
    }
    public function getDisciplinesByUserId($id)
    {
        return $this->disciplineRepository->getDisciplinesByUserId($id);
    } 
}
