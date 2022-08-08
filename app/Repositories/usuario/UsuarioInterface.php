<?php
namespace App\Repositories\usuario;

interface UsuarioInterface {
  public function usuarioAsignadoFindOrFailById($id_usuario, $acceso, $relaciones);

  public function getPagination($request, $acceso);

  public function store($request);

  public function update($request, $id_usuario);

  public function destroy($id_usuario);

  public function reEnviarCorreoBienvenida($id_usuario);

  public function getUsuarioFindOrFail($id_usuario, $relaciones);

  public function getAllUsersPlunk();

  public function getAllClientesPlunk();

  public function getAllClientesIdPlunk();
}