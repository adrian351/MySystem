<?php
use Illuminate\Database\Seeder;
// Models
use App\Models\Pedido;
// Repositories
use App\Repositories\sistema\serie\SerieRepositories;

class PedidosTableSeeder extends Seeder {
    protected $serieRepo;
    public function __construct(SerieRepositories $serieRepositories) {
      $this->serieRepo  = $serieRepositories;
    } 
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(Pedido::class, 50)->create(); // min
        // factory(Pedido::class, 10000)->create(); // max
        $pedidos = Pedido::get();
        $hastaC = count($pedidos) - 1;
        $menos_dia = date("Y-m-d", strtotime('-15 day', strtotime(date("Y-m-d"))));
        for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
          $pedidos[$contador2]->num_pedido = $this->serieRepo->sumaUnoALaUltimaSerie('Pedidos (Serie)', $pedidos[$contador2]->serie);
          $pedidos[$contador2]->fech_de_entreg = $menos_dia;
          $menos_dia = date("Y-m-d", strtotime('+1 day', strtotime($menos_dia)));
          $pedidos[$contador2]->save();
        }
    }
}