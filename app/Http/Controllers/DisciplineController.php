<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DisciplineService;
use App\Repositories\DisciplineRepository;

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
        $result = $this->disciplineService->getDisciplinesByUserId($id);
        return $result;
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $this->disciplineService->createDiscipline($data);
    }

    public function getDisciplineById($id)
    {
        $result = $this->disciplineService->getDisciplineById($id);
        return $result;
    }
    public function deleteDiscipline($id)
    {
        $this->disciplineService->deleteDiscipline($id);
    }
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $this->disciplineService->updateDiscipline($data, $id);
    }
}
