<?php
namespace App\Exports\tecnologiaDeLaInformacion\inventario;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
// Models
use App\Models\InventarioEquipo;

class generarReporteTIExport implements FromView {
    use Exportable;
    public function view(): View {
        return view('tecnologia_de_la_informacion.inventarioEquipo.export.inv_generarReporte', [
            'equipos' => InventarioEquipo::get()
        ]);
    }
}