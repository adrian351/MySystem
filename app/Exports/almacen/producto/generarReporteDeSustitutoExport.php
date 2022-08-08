<?php
namespace App\Exports\almacen\producto;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
// Models
use App\Models\Producto;
use DB;

class generarReporteDeSustitutoExport implements FromView {
    use Exportable;

    // private $fecha_1;
    // private $fecha_2;
    // private $fecha;

    // public function __construct($fecha_1, $fecha_2, $fecha) {
    //     $this->fecha_1             = $fecha_1;
    //     $this->fecha_2             = $fecha_2;
    //     $this->fecha               = $fecha;
    // }

    public function view(): View {

        $productos = DB::table('pedido_armado_producto_tiene_sustitutos')
        ->select(
            'pedido_armados.cod', 'pedido_armados.nom', 'pedido_armados.cant as ACant', 
            'pedido_armado_tiene_productos.id_producto', 'pedido_armado_tiene_productos.cant as PACant', 'pedido_armado_tiene_productos.produc', 'pedido_armado_producto_tiene_sustitutos.id_producto as id_PSustituto', 'pedido_armado_producto_tiene_sustitutos.cant as CSustituto',
            'pedido_armado_producto_tiene_sustitutos.produc as PSustituto', 'pedido_armado_producto_tiene_sustitutos.created_at')
        ->join('pedido_armado_tiene_productos', 'pedido_armado_tiene_productos.id', '=', 'pedido_armado_producto_tiene_sustitutos.producto_id')
        ->join('pedido_armados', 'pedido_armados.id', '=', 'pedido_armado_tiene_productos.pedido_armado_id')
        // ->where('pedido_armado_producto_tiene_sustitutos.created_at' > '2021-05-01')
        ->whereBetween('pedido_armado_producto_tiene_sustitutos.created_at', [
                            date("Y-m-d", strtotime('-30 day', strtotime(date("Y-m-d")))), 
                            date("Y-m-d", strtotime('+1 day', strtotime(date("Y-m-d"))))
                        ])
        ->orderBy('pedido_armado_producto_tiene_sustitutos.id_producto', 'ASC')->get();

        return view('almacen.producto.exports.reporteDeSustitutos', [
            'productos' => $productos
        ]);
    }
}

// date('Y-m-d', strtotime( date($this->fecha_1))),
//               // date("Y-m-d", strtotime('+1 day', strtotime(date($this->fecha_2))))
// date('Y-m-d', strtotime( date($this->fecha_2)))