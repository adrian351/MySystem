<?php
use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
      Producto::create([
        'id'                => 1,
        'produc'            => 'Viruta',
        'pro_de_cat'        => 'Producto de catálogo',
        'sku'               => '123456',
        'marc'              => 'sin',
        'tip'               => 'Producto',
        'prove'             => 'CANASTAS Y ARCONES',
        'prec_prove'        => 0.00,
        'utilid'            => '.4',
        'prec_clien'        => 0.00,
        'categ'             => 'Adicional',
        'pes'               => 0.000,
        'cod_barras'        => '-',
        'asignado_prod'  	  => 'desarrolloweb.ewmx@gmail.com',
        'created_at_prod'   => 'desarrolloweb.ewmx@gmail.com',
      ]);
      Producto::create([
        'id'                => 2,
        'produc'            => 'Tarjeta Navideña',
        'pro_de_cat'        => 'Producto de catálogo',
        'sku'               => '12345',
        'marc'              => 'sin',
        'tip'               => 'Producto',
        'prove'             => 'CANASTAS Y ARCONES',
        'prec_prove'        => 0.00,
        'utilid'            => '.4',
        'prec_clien'        => 0.00,
        'categ'             => 'Adicional',
        'pes'               => 0.000,
        'cod_barras'        => '-',
        'asignado_prod'  	  => 'desarrolloweb.ewmx@gmail.com',
        'created_at_prod'   => 'desarrolloweb.ewmx@gmail.com',
      ]);
      Producto::create([
        'id'                => 3,
        'produc'            => 'Moño',
        'pro_de_cat'        => 'Producto de catálogo',
        'sku'               => '1234',
        'marc'              => 'sin',
        'tip'               => 'Producto',
        'prove'             => 'CANASTAS Y ARCONES',
        'prec_prove'        => 0.00,
        'utilid'            => '.4',
        'prec_clien'        => 0.00,
        'categ'             => 'Adicional',
        'pes'               => 0.000,
        'cod_barras'        => '-',
        'asignado_prod'  	  => 'desarrolloweb.ewmx@gmail.com',
        'created_at_prod'   => 'desarrolloweb.ewmx@gmail.com',
      ]);
      Producto::create([
        'id'                => 4,
        'produc'            => 'Emplayado',
        'pro_de_cat'        => 'Producto de catálogo',
        'sku'               => '123',
        'marc'              => 'sin',
        'tip'               => 'Producto',
        'prove'             => 'CANASTAS Y ARCONES',
        'prec_prove'        => 0.00,
        'utilid'            => '.4',
        'prec_clien'        => 0.00,
        'categ'             => 'Adicional',
        'pes'               => 0.000,
        'cod_barras'        => '-',
        'asignado_prod'  	  => 'desarrolloweb.ewmx@gmail.com',
        'created_at_prod'   => 'desarrolloweb.ewmx@gmail.com',
      ]);
      Producto::create([
        'id'                => 5,
        'produc'            => 'Armado',
        'pro_de_cat'        => 'Producto de catálogo',
        'sku'               => '3456',
        'marc'              => 'sin',
        'tip'               => 'Producto',
        'prove'             => 'CANASTAS Y ARCONES',
        'prec_prove'        => 0.00,
        'utilid'            => '.4',
        'prec_clien'        => 0.00,
        'categ'             => 'Adicional',
        'pes'               => 0.000,
        'cod_barras'        => '-',
        'asignado_prod'  	  => 'desarrolloweb.ewmx@gmail.com',
        'created_at_prod'   => 'desarrolloweb.ewmx@gmail.com',
      ]);
      factory(App\Models\Producto::class, 1100)->create(); // Nota no puede haber mas armados que productos o fallaran los seeds
      // factory(App\Models\Producto::class, 9000)->create(); // Nota no puede haber mas armados que productos o fallaran los seeds
    }
}
