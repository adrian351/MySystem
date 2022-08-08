<?php
use Illuminate\Database\Seeder;

class InventarioEquipoArchivoTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(App\Models\InventarioEquipoArchivo::class, 500)->create(); // min
        // factory(App\Models\InventarioEquipoArchivo::class, 10000)->create(); // max
    }
}
