<?php
use Illuminate\Database\Seeder;
use App\Models\PedidoArmado;
use App\Models\Pedido;

class PedidoArmadosTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
      factory(PedidoArmado::class, 1200)->create(); // min
      // factory(PedidoArmado::class, 18000)->create(); // max
      $pedidos = Pedido::with('armados')->get();
      $cant_armados = null;

      $hastaC = count($pedidos) - 1;
      for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
        $cant_armados = $pedidos[$contador2]->armados()->where('estat', '!=', config('app.cancelado'))->sum('cant');
        $pedidos[$contador2]->tot_de_arm  += $cant_armados;
        $pedidos[$contador2]->arm_carg    += $cant_armados;
        $pedidos[$contador2]->save();
        $cant_armados = null;
      }
    }
}
