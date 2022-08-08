<?php
use Illuminate\Database\Seeder;
use App\Models\Proveedor;

class ProveedoresTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
      Proveedor::create([
        'id'                => 1,
        'raz_soc'           => 'CANASTAS Y ARCONES 1',
        'nom_comerc'        => 'CANASTAS Y ARCONES',
        'fab_distri'        => 'Distribuidor',
        'rfc'               => '2H9D74HM26Z1P',
        'nom_rep_legal'     => 'Prueba',
        'lad_mov'  			    => '55',
        'tel_mov'           => '561013',
        'call'              => 'Peba',
        'no_ext'            => '4',
        'ciudad'            => 'Prueba ciu',
        'col'               => 'Prueba col',
        'del_o_munic'       => 'Prueba del',
        'cod_post'          => '464',
        'asignado_prov'     => 'desarrolloweb.ewmx@gmail.com',
        'created_at_prov'   => 'desarrolloweb.ewmx@gmail.com'
      ]);
      factory(App\Models\Proveedor::class, 100)->create(); // min
      // factory(App\Models\Proveedor::class, 10000)->create(); // max
    }
}