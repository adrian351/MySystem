<?php
use Illuminate\Database\Seeder;
///Models
use App\Models\PedidoArmadoTieneDireccion;
class PedidoArmadoTieneDireccionesTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(PedidoArmadoTieneDireccion::class, 1000)->create();
        // factory(PedidoArmadoTieneDireccion::class, 10000)->create();
    }
}
