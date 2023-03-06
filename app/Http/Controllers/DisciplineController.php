<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DisciplineService;

class DisciplineController extends Controller
{
    protected $discipline;
    private DisciplineService $disciplineService;

    public function __construct(DisciplineService $disciplineService)
    {
        $this->disciplineService = $disciplineService;
    }

    public function getDisciplinesByUserId($id)
    {
        return $this->disciplineService->getDisciplinesByUserId($id);
    }
    public function getDisciplineById($id)
    {
        return $this->disciplineService->getDisciplineById($id);
    }
    public function deleteDiscipline($id)
    {
        $this->disciplineService->deleteDiscipline($id);
    }
    public function createOrUpdateDiscipline(Request $data)
    {
        $this->disciplineService->createOrUpdateDiscipline($data);
    }
}
