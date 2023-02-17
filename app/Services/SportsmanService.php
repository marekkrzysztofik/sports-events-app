<?php
 
namespace App\Services;
use App\Models\Sportsman;

class SportsmanService
{
    public function createSportsman($data)
    {
      $sportsman = new Sportsman;
      $sportsman->name = $data['name'];
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
}
