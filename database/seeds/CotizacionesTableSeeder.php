<?php
use Illuminate\Database\Seeder;
// Models
use App\Models\Cotizacion;
// Repositories
use App\Repositories\sistema\serie\SerieRepositories;

class CotizacionesTableSeeder extends Seeder {
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
        factory(Cotizacion::class, 100)->create(); // min
        // factory(Cotizacion::class, 10000)->create(); // max
        $cotizaciones = Cotizacion::get();
        $hastaC = count($cotizaciones) - 1;
        for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
            $cotizaciones[$contador2]->serie = $this->serieRepo->sumaUnoALaUltimaSerie('Cotizaciones (Serie)', $cotizaciones[$contador2]->ser);
            $cotizaciones[$contador2]->save();
        }
    }
}
