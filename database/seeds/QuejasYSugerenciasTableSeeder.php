<?php
use Illuminate\Database\Seeder;

class QuejasYSugerenciasTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(App\Models\QuejaYSugerencia::class, 800)->create();
        // factory(App\Models\QuejaYSugerencia::class, 10000)->create();
    }
}
