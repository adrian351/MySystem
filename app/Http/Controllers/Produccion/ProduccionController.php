<?php
namespace App\Http\Controllers\Produccion;
use App\Http\Controllers\Controller;

class ProduccionController extends Controller {
  public function index() {
    return view('produccion.prod_index');
  }
}
