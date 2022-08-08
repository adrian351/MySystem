<?php
use Illuminate\Database\Seeder;

class SoporteArchivosTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    factory(App\Models\SoporteArchivo::class, 250)->create(); // min
    // factory(App\Models\SoporteArchivo::class, 5000)->create(); // max
  }
}
