<?php
use Illuminate\Database\Seeder;

class PagosTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(App\Models\Pago::class, 500)->create(); // min
        // factory(App\Models\Pago::class, 12000)->create(); // max
    }
}
