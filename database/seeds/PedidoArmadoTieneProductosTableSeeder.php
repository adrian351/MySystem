<?php
use Illuminate\Database\Seeder;
use App\Models\PedidoArmadoTieneProducto;

class PedidoArmadoTieneProductosTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    factory(PedidoArmadoTieneProducto::class, 1500)->create(); // min
    // factory(PedidoArmadoTieneProducto::class, 19000)->create(); // max
  }
}
