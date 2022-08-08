<?php
use Illuminate\Database\Seeder;

class SoportesTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    factory(App\Models\Soporte::class, 500)->create(); // min
    // factory(App\Models\Soporte::class, 10000)->create(); // max
  }
}
