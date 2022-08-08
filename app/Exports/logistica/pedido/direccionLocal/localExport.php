<?php
namespace App\Exports\logistica\pedido\direccionLocal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;

class localExport implements FromView {
  use Exportable;

  public function view(): View {
    $direcciones =  \App\Models\PedidoArmadoTieneDireccion::with(['armado'=> function ($query) {
      $query->select('id', 'cod', 'pedido_id')->with(['pedido'=> function ($query) {
        $query->select('id', 'fech_de_entreg', 'estat_pag', 'bod');
      }]);
    }])
    ->where('for_loc', 'Local')
    ->where(function ($query) {
      $query->where('estat', config('app.pendiente'))
      ->orWhere('estat', config('app.en_almacen_de_salida'))
        ->orWhere('estat', config('app.en_ruta'))
        ->orWhere('estat', config('app.sin_entrega_por_falta_de_informacion'))
        ->orWhere('estat', config('app.intento_de_entrega_fallido'));
      })
    ->orderBy('fech_en_alm_salida', 'DESC')
    ->get();
    return view('logistica.pedido.pedido_activo.export.direccionLocal', ['direcciones'    => $direcciones]);
  }
}