<?php
namespace App\Repositories\cliente;

interface ClienteInterface {
  public function store($request);

  public function update($request, $id_cliente);

  public function destroy($id_cliente);

  public function reEnviarCorreoBienvenida($id_cliente);
}