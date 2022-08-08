<?php
use Illuminate\Database\Seeder;

class ArmadosTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(App\Models\Armado::class, 1000)->create(); // min
        // factory(App\Models\Armado::class, 10000)->create(); // max
    }
}