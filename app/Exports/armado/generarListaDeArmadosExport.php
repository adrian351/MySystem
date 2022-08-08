<?php
namespace App\Exports\armado;
use App\Models\Armado;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;

class generarListaDeArmadosExport implements FromView {
    use Exportable;
    public function query() {
        return Armado::query();
    }
    public function view(): View {
        return view('armado.export.arm_list_export', [
            'armados' => Armado::with('productos', 'marca')->where('clon', '0')->orderBy('id', 'ASC')->get()
        ]);
    }
}