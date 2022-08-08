<?php
namespace App\Exports\produccion;
use App\Models\Pedido;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;

class reporteProduccionExport implements FromView {
  use Exportable;

    public function view(): View {
        return view('produccion.pedido.pedido_activo.export.produccion_export', [
            'pedidos' => Pedido::where('estat_produc', '!=', 'En almacén de salida terminado')
                ->whereDate('created_at', '>', '2021-01-01')
                ->get(),
    ]);
}
}