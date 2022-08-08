<?php
use Illuminate\Database\Seeder;
use App\Models\Estado;
class EstadoTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    Estado::create([
      'id'              => 1,
      'est'             => 'Ciudad de México (Ciudad de México)',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Local'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]); 
    Estado::create([
      'id'              => 2,
      'est'             => 'Aguascalientes (Aguascalientes)',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 3,
      'est'             => 'Baja California (Mexicali)',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 4,
      'est'             => 'Baja California Sur (La Paz)',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 5,
      'est'             => 'Campeche (Campeche)',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 6,
      'est'             => 'Chiapas (Tuxtla Gutiérrez)',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 7,
      'est'             => 'Chihuahua (Chihuahua)',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);

    Estado::create([
      'id'              => 8,
      'est'             => 'Coahuila de Zaragoza (Saltillo)',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 9,
      'est'             => 'Colima (Colima)',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 10,
      'est'             => 'Durango (Victoria de Durango)',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 11,
      'est'             => 'Guanajuato (Guanajuato)',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 12,
      'est'             => 'Guerrero (Chilpancingo de los Bravo)',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 13,
      'est'             => 'Hidalgo (Pachuca de Soto)',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 14,
      'est'             => 'Jalisco (Guadalajara)',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 15,
      'est'             => 'México (Edo. México)',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo y Local'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 16,
      'est'             => 'Michoacán de Ocampo (Morelia)',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 17,
      'est'             => 'Morelos (Cuernavaca)',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 18,
      'est'             => 'Nayarit (Tepic)',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 19,
      'est'             => 'Nuevo León (Monterrey)',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 20,
      'est'             => 'Oaxaca (Oaxaca de Juárez)',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 21,
      'est'             => 'Puebla (H. Puebla de Zaragoza)',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 22,
      'est'             => 'Querétaro (Santiago de Querétaro)',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 23,
      'est'             => 'Quintana Roo (Cd. Chetumal)',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 24,
      'est'             => 'San Luis Potosí (San Luis Potosí)',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 25,
      'est'             => 'Sinaloa (Culiacán Rosales)',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 26,
      'est'             => 'Sonora (Hermosillo)',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 27,
      'est'             => 'Tabasco (Villahermosa)',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 28,
      'est'             => 'Tamaulipas (Ciudad Victoria)',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 29,
      'est'             => 'Tlaxcala (Tlaxcala de Xicohténcatl)',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 30,
      'est'             => 'Veracruz de Ignacio de la Llave (Xalapa de Enríquez)',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 31,
      'est'             => 'Yucatán (Mérida)',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]); 
    Estado::create([
      'id'              => 32,
      'est'             => 'Zacatecas (Zacatecas)',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
    Estado::create([
      'id'              => 33,
      'est'             => 'Tarifa única (Varios estados)',
      'for_loc'         => config('opcionesSelect.select_foraneo_local_ambos.Foráneo y Local'),
      'asignado_est'	  => 'desarrolloweb.ewmx@gmail.com',
      'created_at_est'  => 'desarrolloweb.ewmx@gmail.com',
    ]);
  }
}
