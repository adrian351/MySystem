<?php
use Illuminate\Database\Seeder;
use App\Models\Producto;
use App\Models\Proveedor;
// Repositories
use App\Repositories\servicio\calculo\CalculoRepositories;

class ProductoTieneProveedoresTableSeeder extends Seeder {
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
        $productos = Producto::with('proveedores')->get();
        $hastaC = count($productos) - 1;
        for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
            $proveedor = Proveedor::where('nom_comerc', $productos[$contador2]->prove)->first();
            $productos[$contador2]->prec_clien = $this->calculoRepo->getUtilidadProducto($productos[$contador2]->prec_prove, $productos[$contador2]->utilid, $productos[$contador2]->cost_arm);
            $productos[$contador2]->save();
            $productos[$contador2]->proveedores()->attach($proveedor->id, [
                'prec_prove'    => $productos[$contador2]->prec_prove,
                'utilid'        => $productos[$contador2]->utilid,
                'prec_clien'    => $productos[$contador2]->prec_clien
            ]);
        }
    }
}