<?php
namespace App\Repositories\subCategoria;

interface SubCategoriaInterface {
    public function subCategoriaAsignadoFindOrFailById($id_subCategoria);

    public function getPagination($request);

    public function store($request);

    public function update($request, $id_subCategoria);

    public function destroy($id_subCategoria);

    public function Only_SubCategorias();
}