<?php
use Illuminate\Database\Seeder;

class InventarioEquiposTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    factory(App\Models\InventarioEquipo::class, 5)->create(); // min
    // factory(App\Models\InventarioEquipo::class, 10000)->create(); // max
  }
}
