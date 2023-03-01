<?php

namespace App\Services;

use App\Models\Sportsman;
use Illuminate\Http\Request;
 
class SportsmanService
{
  public function createSportsman($data)
  {
    $sportsman = new Sportsman;
    $sportsman->name = $data['name'];
    $sportsman->user_id = $data['user_id'];
    $sportsman->surname = $data['surname'];
    $sportsman->sex = $data['sex']; 
    $sportsman->age = $data['age'];
    $sportsman->save();
  }

  public function deleteSportsman($id)
  {
    $sportsman = Sportsman::findOrFail($id);
    $sportsman->delete();
  }
  public function updateSportsman(Request $request, $id)
  {
    $sportsman = Sportsman::find($id);
    $sportsman->name = $request['name'];
    $sportsman->surname = $request['surname'];
    $sportsman->sex = $request['sex'];
    $sportsman->age = $request['age'];
    $sportsman->save();
    $sportsman->save();
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
