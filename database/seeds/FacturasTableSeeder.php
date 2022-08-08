<?php
use Illuminate\Database\Seeder;

class FacturasTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(App\Models\Factura::class, 350)->create(); // min
        //factory(App\Models\Factura::class, 10000)->create(); // max
    }
}