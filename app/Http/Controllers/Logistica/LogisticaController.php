<?php
namespace App\Http\Controllers\Logistica;
use App\Http\Controllers\Controller;

class LogisticaController extends Controller {
  public function index() {
    return view('logistica.log_index');
  }
}
