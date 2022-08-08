<?php
use Illuminate\Database\Seeder;
use App\Models\Catalogo;

class CatalogosTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
  public function run() {
      Catalogo::create([
        'input'             => 'Armados (Gama)',
        'value'             => 'Premium',
        'vista'             => 'Premium',
        'asignado_cat'  	=> 'desarrolloweb.ewmx@gmail.com',
        'created_at_cat'    => 'desarrolloweb.ewmx@gmail.com',
      ]);
      Catalogo::create([
        'input'             => 'Armados (Gama)',
        'value'             => 'Económica',
        'vista'             => 'Económica',
        'asignado_cat'  	=> 'desarrolloweb.ewmx@gmail.com',
        'created_at_cat'    => 'desarrolloweb.ewmx@gmail.com',
      ]);
      Catalogo::create([
        'input'             => 'Armados (Gama)',
        'value'             => 'Intermedia',
        'vista'             => 'Intermedia',
        'asignado_cat'  	=> 'desarrolloweb.ewmx@gmail.com',
        'created_at_cat'    => 'desarrolloweb.ewmx@gmail.com',
      ]);        
      Catalogo::create([
        'input'             => 'Armados (Gama)',
        'value'             => 'Ejecutiva',
        'vista'             => 'Ejecutiva',
        'asignado_cat'  	=> 'desarrolloweb.ewmx@gmail.com',
        'created_at_cat'    => 'desarrolloweb.ewmx@gmail.com',
      ]);        
      Catalogo::create([
        'input'             => 'Armados (Gama)',
        'value'             => 'Empresarial',
        'vista'             => 'Empresarial',
        'asignado_cat'  	=> 'desarrolloweb.ewmx@gmail.com',
        'created_at_cat'    => 'desarrolloweb.ewmx@gmail.com',
      ]);        
      Catalogo::create([
        'input'             => 'Armados (Gama)',
        'value'             => 'Express',
        'vista'             => 'Express',
        'asignado_cat'  	=> 'desarrolloweb.ewmx@gmail.com',
        'created_at_cat'    => 'desarrolloweb.ewmx@gmail.com',
      ]);
      Catalogo::create([
        'input'             => 'Armados (Tipo)',
        'value'             => 'Arcón',
        'vista'             => 'Arcón',
        'asignado_cat'  	=> 'desarrolloweb.ewmx@gmail.com',
        'created_at_cat'    => 'desarrolloweb.ewmx@gmail.com',
      ]);
      Catalogo::create([
        'input'             => 'Armados (Tipo)',
        'value'             => 'Despensa',
        'vista'             => 'Despensa',
        'asignado_cat'  	=> 'desarrolloweb.ewmx@gmail.com',
        'created_at_cat'    => 'desarrolloweb.ewmx@gmail.com',
      ]);
      Catalogo::create([
        'input'             => 'Armados (Tipo)',
        'value'             => 'Gel',
        'vista'             => 'Gel',
        'asignado_cat'  	=> 'desarrolloweb.ewmx@gmail.com',
        'created_at_cat'    => 'desarrolloweb.ewmx@gmail.com',
      ]);
      Catalogo::create([
        'input'             => 'Productos (Categoría)',
        'value'             => 'Adicional',
        'vista'             => 'Adicional',
        'asignado_cat'  	  => 'desarrolloweb.ewmx@gmail.com',
        'created_at_cat'    => 'desarrolloweb.ewmx@gmail.com',
      ]);
        factory(App\Models\Catalogo::class, 100)->create(); // min
      //  factory(App\Models\Catalogo::class, 10000)->create(); // max
    }
}
