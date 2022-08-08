<?php
use Illuminate\Database\Seeder;
use App\Models\Manual;

class ManualesTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    Manual::create([
      'usu_cli_ambos'   => 'Usuario',
      'valor'           => 'Administrador de usuarios',
      'rut'             => env('PREFIX'),
      'nom'	            => 'sistema/manuales/Usuarios.pdf',
      'rut_edit'        => env('PREFIX'),
      'nom_edit'	      => 'sistema/manuales/Usuarios.pdf',
      'created_at_reg'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Manual::create([
      'usu_cli_ambos'   => 'Usuario',
      'valor'           => 'Administrador de clientes',
      'rut'             => env('PREFIX'),
      'nom'	            => 'sistema/manuales/Clientes.pdf',
      'rut_edit'        => env('PREFIX'),
      'nom_edit'	      => 'sistema/manuales/Clientes.pdf',
      'created_at_reg'  => 'desarrolloweb.ewmx@gmail.com',
    ]); 

    factory(App\Models\Manual::class, 10)->create(); // min
  }
}
