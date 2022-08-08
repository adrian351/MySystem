<?php
namespace App\Exports\almacen\producto;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
// Models
use App\Models\Producto;

class generarReporteDeCompraExport implements FromView {
    use Exportable;

    private $fecha_1;
    private $fecha_2;
    private $fecha;

    public function __construct($fecha_1, $fecha_2, $fecha) {
        $this->fecha_1             = $fecha_1;
        $this->fecha_2             = $fecha_2;
        $this->fecha               = $fecha;
    }

    public function view(): View {
      if( $this->fecha_1 != null && $this->fecha_2 != null){
        $pedidos = \App\Models\Pedido:: 
          with(['armados' => function($query1) {
            $query1->with('productos')->select(['id', 'nom', 'cant',  'created_at', 'pedido_id']);
          }])
            ->whereBetween('created_at', [
              date('Y-m-d', strtotime( date($this->fecha_1))),
              // date("Y-m-d", strtotime('+1 day', strtotime(date($this->fecha_2))))
              date('Y-m-d', strtotime( date($this->fecha_2)))
            ])
              ->orderBy('id', 'DESC')
              ->get(['id', 'num_pedido']);

          }elseif($this->fecha != null){
            $pedidos = \App\Models\Pedido:: 
            with(['armados' => function($query1) {
              $query1->with('productos')->select(['id', 'nom', 'cant', 'created_at', 'pedido_id']);
            }])
            ->whereDate('created_at',
                date('Y-m-d', strtotime( date($this->fecha)))
              )
              ->orderBy('id', 'DESC')
              ->get(['id', 'num_pedido']);
          }
            $contador4 = 0;
            foreach($pedidos as $pedido) {
              foreach($pedido->armados as $armado) {
                foreach($armado->productos as $producto) {
                  $productos[$contador4]['id'] = $producto->id_producto;
                  $productos[$contador4]['cantidad'] = $producto->cant;
                  $productos[$contador4]['sku'] = $producto->sku;
                  $productos[$contador4]['fecha'] = $armado->created_at;
                  // $productos[$contador4]['precio'] = $producto->prec_clien;
                  $productos[$contador4]['cantidad_armado'] = $armado->cant;
                  $productos[$contador4]['nombre_producto'] = $producto->produc;
                  $contador4 ++;
                }
              }
            }
            // 
            $nuevo_array = [];
            $contador2 = 0;
            for($contador1 = 0;$contador1<count($productos);$contador1++) {
              if(empty($nuevo_array)) {
                $nuevo_array[$contador2]['id'] = $productos[$contador1]['id'];
                $nuevo_array[$contador2]['cantidad'] = $productos[$contador1]['cantidad']*$productos[$contador1]['cantidad_armado'];
                $nuevo_array[$contador2]['sku'] = $productos[$contador1]['sku'];
                $nuevo_array[$contador2]['fecha'] = $productos[$contador1]['fecha'];
                // $nuevo_array[$contador2]['precio'] = $productos[$contador1]['precio'];
                $nuevo_array[$contador2]['nombre_producto'] = $productos[$contador1]['nombre_producto'];
                $contador2 ++;
              }else {
                $existe = 'No';
                for($contador3 = 0;$contador3<count($nuevo_array) ;$contador3++) {
                  if($nuevo_array[$contador3]['id'] == $productos[$contador1]['id']) {
                    $existe = 'Si';
                    $num_contador_repetido = $contador3;
                  }           
                }
                if($existe == 'No') {
                  $nuevo_array[$contador2]['id'] = $productos[$contador1]['id'];
                  $nuevo_array[$contador2]['cantidad'] = $productos[$contador1]['cantidad']*$productos[$contador1]['cantidad_armado'];
                  $nuevo_array[$contador2]['sku'] = $productos[$contador1]['sku'];
                  $nuevo_array[$contador2]['fecha'] = $productos[$contador1]['fecha'];
                  // $nuevo_array[$contador2]['precio'] = $productos[$contador1]['precio'];
                  $nuevo_array[$contador2]['nombre_producto'] = $productos[$contador1]['nombre_producto'];
                  $contador2 ++;
                } else {
                  $nuevo_array[$num_contador_repetido]['cantidad'] += $productos[$contador1]['cantidad']*$productos[$contador1]['cantidad_armado'];
                }
              }
            }
       

        // return view('almacen.producto.exports.alm_pro_exp_generarReporteDeCompra', ['pedidos' => $nuevo_array ]);

        return view('almacen.producto.exports.alm_pro_exp_generarReporteDeCompra', [
            'productos' => $nuevo_array
        //     // 'productos' => Producto::with(['sustitutos', 'productos_pedido' => function($query) {
        //     //     $query->with(['armado' => function($query) {
        //     //         $query->whereBetween('created_at', [
        //     //             date("Y-m-d", strtotime('-110 day', strtotime(date("Y-m-d")))), 
        //     //             date("Y-m-d", strtotime('+1 day', strtotime(date("Y-m-d"))))
        //     //         ]);
        //     //     }]);
        //     // }])->orderBy('id', 'DESC')->get()
        ]);
    }
}