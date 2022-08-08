<?php
use Illuminate\Database\Seeder;

class HistorialesArchivosTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()    {
      factory(App\Models\HistorialArchivo::class, 500)->create();
  }
}
