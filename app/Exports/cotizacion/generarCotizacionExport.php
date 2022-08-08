<?php
namespace App\Exports\cotizacion;
use App\Models\Cotizacion;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;

class generarCotizacionExport implements FromView {
  use Exportable;
  private $id_cotizacion;

  public function __construct($id_cotizacion){
    $this->id_cotizacion = $id_cotizacion;
  }
  public function view(): View {
    $cotizacion = Cotizacion::with('armados')->orderBy('id', 'DESC')->findOrFail($this->id_cotizacion);
    return view('cotizacion.export.generarCotizacion', [
      'cotizacion'    => $cotizacion,
      'armados'       => $cotizacion->armados()->with('productos')->paginate(99999999)
    ]);
  }
}