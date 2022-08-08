<?php
namespace App\Repositories\almacen\producto\imagen;
// Models
use App\Models\ProductoImagen;
// Events
use App\Events\layouts\ArchivoCargado;
// Repositories
use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class ImagenRepositories implements ImagenInterface {
  protected $serviceCrypt;
  protected $papeleraDeReciclajeRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories) {
    $this->serviceCrypt     = $serviceCrypt;
    $this->papeleraDeReciclajeRepo  = $papeleraDeReciclajeRepositories;
  }
  public function imagenFindOrFailById($id_producto, $relaciones) {
    $id_producto = $this->serviceCrypt->decrypt($id_producto);
    $imagen = ProductoImagen::with($relaciones)->findOrFail($id_producto);
    return $imagen;
  }
  public function store($request, $id_producto) {
    DB::transaction(function() use($request, $id_producto) {  // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $camposBD   = array('img_rut', 'img_nom', 'producto_id', 'created_at_reg', 'created_at');
      $hastaC     = count($request->imagenes) - 1;
      $datos      = null;
      $contador3  = 0;
      $id_producto  = $this->serviceCrypt->decrypt($id_producto);
      $email_usuario = Auth::user()->email_registro;
      $fecha = date('Y-m-d h:i:s');

      for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        $imagen = ArchivoCargado::dispatch(
          $request->imagenes[$contador2], // Archivo blob
          'almacen/productos/' . date("Y"), // Ruta en la que guardara el archivo
          'producto-' . $contador2 . time() . '.', // Nombre del archivo
          null // Ruta y nombre del archivo anterior
        ); 
        $datos[$contador2][$camposBD[$contador3]] = $imagen[0]['ruta'];
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $imagen[0]['nombre'];
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $id_producto;
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $email_usuario;
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $fecha;
        $contador3 = 0;
      }

      ProductoImagen::insert($datos);
      return true;
    });
  }
  public function destroy($id_imagen) {
    DB::transaction(function() use($id_imagen) {  // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $img_producto = $this->imagenFindOrFailById($id_imagen, []);
      $img_producto->delete();

      $this->papeleraDeReciclajeRepo->store([
        'modulo'      => 'Imagenes producto', // Nombre del módulo del sistema
        'registro'    => $img_producto->img_nom, // Información a mostrar en la papelera
        'tab'         => 'producto_imagenes', // Nombre de la tabla en la BD
        'id_reg'      => $img_producto->id, // ID de registro eliminado
        'id_fk'       => $img_producto->producto_id // ID de la llave foranea con la que tiene relación           
      ]);
    });
  }
}