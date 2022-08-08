<?php
namespace App\Repositories\sistema\manual;

interface ManualInterface {
  public function manualFindOrFailById($id_manual);

  public function getPagination($request);

  public function store($request);

  public function update($request, $id_manual);

  Public function destroy($id_manual);
}