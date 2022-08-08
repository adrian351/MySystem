<?php
namespace App\Http\Controllers\Venta;
use App\Http\Controllers\Controller;

class VentaController extends Controller {
  public function index() {
    return view('venta.ven_index');
  }
}