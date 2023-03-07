<?php

namespace App\Services;

use App\Repositories\SportsmanRepository;
use App\Models\Sportsman;
use Illuminate\Http\Request;

class SportsmanService
{
  protected $sportsmanRepository;

  public function __construct(SportsmanRepository $sportsmanRepository)
  {
    $this->sportsmanRepository = $sportsmanRepository;
  }
  public function getSportsmenByUserId($id)
  {
    return $this->sportsmanRepository->getSportsmenByUserId($id);
  }
  public function getSportsmanById($id)
  {
    return $this->sportsmanRepository->getSportsmanById($id);
  }
  public function createSportsman($data)
  {
    $sportsman = new Sportsman;
    $sportsman->name = $data['name'];
    $sportsman->user_id = $data['user_id'];
    $sportsman->surname = $data['surname'];
    $sportsman->sex = $data['sex'];
    $sportsman->age = $data['age'];
    $this->sportsmanRepository->save($sportsman);
  }
  public function deleteSportsman($id)
  {
    $this->sportsmanRepository->delete($id);
  }
  public function updateSportsman(Request $request, $id)
  {
    $sportsman = $this->sportsmanRepository->getSportsmanById($id);
    $sportsman->name = $request['name'];
    $sportsman->surname = $request['surname'];
    $sportsman->sex = $request['sex'];
    $sportsman->age = $request['age'];
    $this->sportsmanRepository->update($sportsman);
  }
  public function createOrUpdateSportsman(Request $request)
  {
    $data = $request->all();
    if (array_key_exists("id", $data) && $data['id']) {
      $this->updateSportsman($request, $data["id"]);
    } else {
      $this->createSportsman($request);
    }
  }
}
