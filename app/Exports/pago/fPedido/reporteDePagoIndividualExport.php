<?php
namespace App\Exports\pago\fPedido;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
// Models
use App\Models\Pago;

class reporteDePagoIndividualExport implements FromView {
    use Exportable;

    private $fecha_inicio;
    private $fecha_fin;
    private $fecha;

    public function __construct($fecha_inicio, $fecha_fin, $fecha) {
        $this->fecha_inicio             = $fecha_inicio;
        $this->fecha_fin                = $fecha_fin;
        $this->fecha                    = $fecha;
    }

    public function view(): View {

        if($this->fecha_inicio != null && $this->fecha_fin != null){
            
            $pagos = Pago::whereBetween('created_at', [
                date('Y-m-d', strtotime( date($this->fecha_inicio))),
                //date('Y-m-d', strtotime( date($this->fecha_fin)))
                date("Y-m-d", strtotime('+1 day', strtotime(date($this->fecha_fin))))
            ])->get();
        }

        if($this->fecha != null){
            $pagos = Pago::whereDate('created_at', 
                date('Y-m-d', strtotime( date($this->fecha)))
            )->get();
        }

        return view('pago.individual.exports.pago_individual', ['pagos' => $pagos]);
    }
}