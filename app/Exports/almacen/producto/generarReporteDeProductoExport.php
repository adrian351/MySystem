<?php
namespace App\Exports\almacen\producto;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
// Models

class generarReporteDeProductoExport implements FromView, ShouldQueue {
    use Exportable;
    public function view(): View {

        $productos = \App\Models\Producto::with(['categoria', 'catalogos'])->orderBy('id', 'DESC')->get();

        return view('almacen.producto.exports.reporteDeProductos', [
            'productos' => $productos
        ]);
    }
}