<?php
use Illuminate\Database\Seeder;

class QuejaYSugerenciaArchivoTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(App\Models\QuejaYSugerenciaArchivo::class, 1200)->create();
        // factory(App\Models\QuejaYSugerenciaArchivo::class, 18000)->create();
    }
}