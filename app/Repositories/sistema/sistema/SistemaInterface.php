<?php
namespace App\Repositories\sistema\sistema;

interface SistemaInterface {
  public function sistemaFindOrFail();

  public function update($request);

  public function datos($campo);
}