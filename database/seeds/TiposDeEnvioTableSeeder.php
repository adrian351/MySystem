<?php
use Illuminate\Database\Seeder;
use App\Models\TipoDeEnvio;

class TiposDeEnvioTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    TipoDeEnvio::create([
      'id'                    => 1,
      'tip_de_env'            => 'Normal',
      'metodo_de_entrega_id'  => 1,
      'created_at_tip'        => 'desarrolloweb.ewmx@gmail.com',
    ]);
    TipoDeEnvio::create([
      'id'                    => 2,
      'tip_de_env'            => 'Express',
      'metodo_de_entrega_id'  => 1,
      'created_at_tip'        => 'desarrolloweb.ewmx@gmail.com',
    ]);
    TipoDeEnvio::create([
      'id'                    => 3,
      'tip_de_env'            => 'Directo',
      'metodo_de_entrega_id'  => 4,
      'created_at_tip'        => 'desarrolloweb.ewmx@gmail.com',
    ]);
    TipoDeEnvio::create([
      'id'                    => 4,
      'tip_de_env'            => 'Consolidado',
      'metodo_de_entrega_id'  => 4,
      'created_at_tip'        => 'desarrolloweb.ewmx@gmail.com',
    ]);
    TipoDeEnvio::create([
      'id'                    => 5,
      'tip_de_env'            => 'Paquetería',
      'metodo_de_entrega_id'  => 4,
      'created_at_tip'        => 'desarrolloweb.ewmx@gmail.com',
    ]);
  }
}
