<?php
namespace App\Exports\logistica\pedido\pedidoActivo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;

class activoExport implements FromView {
  use Exportable;

  public function view(): View {
    $pedidos =  \App\Models\Pedido::with('armados')
    ->where('estat_log', '!=', config('app.entregado'))
/*
    ->where(function ($query) {
      $query->where('estat_log', config('app.en_espera_de_produccion'))
      ->orWhere('estat_log', config('app.en_almacen_de_salida'))
      ->orWhere('estat_log', config('app.en_ruta'))
      ->orWhere('estat_log', config('app.sin_entrega_por_falta_de_informacion'))
      ->orWhere('estat_log', config('app.intento_de_entrega_fallido'));
    })
*/
    ->get();

    return view('logistica.pedido.pedido_activo.export.pedidosActivos', ['pedidos'    => $pedidos]);
  }
}