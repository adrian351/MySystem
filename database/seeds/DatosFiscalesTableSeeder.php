<?php
use Illuminate\Database\Seeder;

class DatosFiscalesTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(App\Models\DatoFiscal::class, 2000)->create(); // min
        // factory(App\Models\DatoFiscal::class, 15000)->create(); // max
    }
}