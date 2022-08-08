<?php
namespace App\Http\Controllers\TecnologiaDeLaInformacion;
use App\Http\Controllers\Controller;

class TecnologiaDeLaInformacionController extends Controller {
  public function index() {
    return view('tecnologia_de_la_informacion.ti_index');
  }
}