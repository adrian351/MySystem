<?php
namespace App\Exports\almacen\producto;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
// Models
use App\Models\ReporteStock;

class generarReporteDeStockExport implements FromView, ShouldQueue {
    use Exportable;
    // accion para descargar el reporte de stock en productos al instante
    public function view(): View {
        return view('almacen.producto.exports.exp_gemerarReporteDeStock', [
            'registros' => ReporteStock::orderBy('id', 'DESC')->get()
        ]);
    }
}
