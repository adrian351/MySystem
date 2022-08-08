<?php
namespace App\Http\Controllers\Almacen;
use App\Http\Controllers\Controller;

class AlmacenController extends Controller {
  public function index() {
    return view('almacen.alm_index');
  }
}