<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Repositories\DisciplineRepository;
use App\Services\DisciplineService;

class DisciplineController extends Controller
{
    private DisciplineRepository $disciplineRepository;
    private DisciplineService $disciplineService;

    public function __construct(DisciplineRepository $disciplineRepository, DisciplineService $disciplineService)
    {
        $this->disciplineRepository = $disciplineRepository;
        $this->disciplineService = $disciplineService;
    }

    public function createDiscipline(Request $request) 
    {
        $data = $request->all();
        $this->disciplineService->createDiscipline($data);
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

    public function updateDisc(Request $id)
    {
        $data = $this->disciplineRepository->editDisc($id);
        return ($this->disciplineService->updateDisc($data,$id));
    }
    // public function createOrUpdateProduct(Request $request)                    
    //  {
    //     $data= $request->all();
    //     if(array_key_exists("id", $data) && $data['id']) {
    //       return $this->updateDiscipline($request, $data["id"]); 
    //     } else {
    //        return $this->createDiscipline($request);
    //     }

    // }
}