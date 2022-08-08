<?php
namespace App\Exports\almacen\pedido;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
// Models
use App\Models\Producto;

class generarReporteExport implements FromView {
    use Exportable;
    private $id_pedidos;
    public function __construct($id_pedidos) {
      $this->id_pedidos             = $id_pedidos;
    }
    public function view(): View {
      // Consulta trae todos los ped
      $pedidos = \App\Models\Pedido::
            with(['armados' => function($query1) {
              $query1->with('productos')->select(['id', 'nom', 'cant', 'pedido_id']);
            }])
            ->where(function($query3) {
              foreach($this->id_pedidos as $id_pedido) {
                $query3->orWhere('id', $id_pedido);
              }
            })->orderBy('id', 'DESC')
            ->get(['id', 'num_pedido']);

            $contador4 = 0;
            foreach($pedidos as $pedido) {
              foreach($pedido->armados as $armado) {
                foreach($armado->productos as $producto) {
                  $productos[$contador4]['id'] = $producto->id_producto;
                  $productos[$contador4]['cantidad'] = $producto->cant;
                  $productos[$contador4]['cantidad_armado'] = $armado->cant;
                  $productos[$contador4]['nombre_producto'] = $producto->produc;
                  $contador4 ++;
                }
              }
            }
            // 
            $nuevo_array = [];
            $contador2 = 0;
            for($contador1 = 0;$contador1<count($productos) ;$contador1++) {
              if(empty($nuevo_array)) {
                $nuevo_array[$contador2]['id'] = $productos[$contador1]['id'];
                $nuevo_array[$contador2]['cantidad'] = $productos[$contador1]['cantidad']*$productos[$contador1]['cantidad_armado'];
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
                  $nuevo_array[$contador2]['nombre_producto'] = $productos[$contador1]['nombre_producto'];
                  $contador2 ++;
                } else {
                  $nuevo_array[$num_contador_repetido]['cantidad'] += $productos[$contador1]['cantidad']*$productos[$contador1]['cantidad_armado'];
                }
              }
            }
/*
            $nuevo_array = [];
            for($a = 0;$a<count($productos) ;$a++) {
              if(empty($nuevo_array)) {
                $cantidad=0;
                for($b=0;$b<count($productos) ;$b++) { 
                      if($productos[$a]['id']==$productos[$b]['id']){
                        $cantidad=$productos[$b]['cantidad']+$cantidad;  
                      }
                }
                  $productos[$a]['cantidad']=$cantidad;
                array_push($nuevo_array, $productos[$a]);
              }else{//// si noi esta vacio
              $bandera=false;
                for($b=0;$b<count($nuevo_array) ;$b++) { 
                  if($productos[$a]['id']==$nuevo_array[$b]['id']){
                  $bandera=true;
             
                  }
            }
            if($bandera){
            }else{///no esta en el array nuevo
              $cantidad=0;
              for($b=0;$b<count($productos) ;$b++) { 
                    if($productos[$a]['id']==$productos[$b]['id']){
                      $cantidad=$productos[$b]['cantidad']+$cantidad;  
                    }
              }
                $productos[$a]['cantidad']=$cantidad;
              array_push($nuevo_array, $productos[$a]);
            }
          }
        }
          */
      return view('almacen.pedido.pedido_activo.export.generarReporte', ['pedidos' => $nuevo_array]);
    }
}