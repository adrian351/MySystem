<?php
use Illuminate\Database\Seeder;
use App\Models\Armado;
use App\Models\Producto;
// Repositories
use App\Repositories\servicio\calculo\CalculoRepositories;

class ArmadoTieneProductosTableSeeder extends Seeder {
    protected $calculoRepo;
    public function __construct(CalculoRepositories $calculoRepositories) {
      $this->calculoRepo = $calculoRepositories;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
      $armados = Armado::with('productos')->where('id', '!=', 1)
      ->where('id', '!=', 2)
      ->where('id', '!=', 3)
      ->where('id', '!=', 4)
      ->where('id', '!=', 5)
      ->where('id', '!=', 6)
      ->where('id', '!=', 7)->get();
      $hastaC = count($armados) - 1;
      $cont = 1;
      for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
        $producto = Producto::where('id', $cont)->first();
        $armados[$contador2]->prec_de_comp  = $producto->prec_prove;
        $armados[$contador2]->prec_origin   = $producto->prec_clien;
        $armados[$contador2]->prec_redond   = $this->calculoRepo->redondearUnidadA9DelPrecio($producto->prec_clien);
        $armados[$contador2]->tam           = $producto->tam;
        $armados[$contador2]->pes           = $producto->pes;
        $armados[$contador2]->alto          = $producto->alto;
        $armados[$contador2]->ancho         = $producto->ancho;
        $armados[$contador2]->largo         = $producto->largo;
        $armados[$contador2]->save();
        $armados[$contador2]->productos()->attach([$producto->id,6,7,1,2,3,4,5]);
        $cont += 1;
      }
    }
}