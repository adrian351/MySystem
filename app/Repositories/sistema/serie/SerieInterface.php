<?php
namespace App\Repositories\sistema\serie;

interface SerieInterface {
  public function serieAsignadoFindOrFailById($id_serie);

  public function getPagination($request);

  public function store($request);

  public function update($request, $id_serie);

  Public function destroy($id_serie);

  public function getAllInputSeriesPlunk($input);

  public function sumaUnoALaUltimaSerie($input, $vista);
}