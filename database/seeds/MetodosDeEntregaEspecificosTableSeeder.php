<?php
use Illuminate\Database\Seeder;
use App\Models\MetodoDeEntregaEspecifico;
class MetodosDeEntregaEspecificosTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    MetodoDeEntregaEspecifico::create([
      'id'                    => 1,
      'nom_met_ent_esp'       => 'Uber',
      'url'                   => null,
      'metodo_de_entrega_id'  => 5,
      'created_at_met_ent'    => 'desarrolloweb.ewmx@gmail.com',
    ]);
    MetodoDeEntregaEspecifico::create([
      'id'                    => 2,
      'nom_met_ent_esp'       => 'Didi',
      'url'                   => null,
      'metodo_de_entrega_id'  => 5,
      'created_at_met_ent'    => 'desarrolloweb.ewmx@gmail.com',
    ]);
    MetodoDeEntregaEspecifico::create([
      'id'                    => 3,
      'nom_met_ent_esp'       => 'Beat',
      'url'                   => null,
      'metodo_de_entrega_id'  => 5,
      'created_at_met_ent'    => 'desarrolloweb.ewmx@gmail.com',
    ]);
    MetodoDeEntregaEspecifico::create([
      'id'                    => 4,
      'nom_met_ent_esp'       => 'Estafeta',
      'url'                   => 'https://www.estafeta.com/Herramientas/Rastreo',
      'metodo_de_entrega_id'  => 1,
      'created_at_met_ent'    => 'desarrolloweb.ewmx@gmail.com',
    ]);
    MetodoDeEntregaEspecifico::create([
      'id'                    => 5,
      'nom_met_ent_esp'       => 'FedEx',
      'url'                   => 'https://www.fedex.com/es-mx/tracking.html',
      'metodo_de_entrega_id'  => 1,
      'created_at_met_ent'    => 'desarrolloweb.ewmx@gmail.com',
    ]);
    MetodoDeEntregaEspecifico::create([
      'id'                    => 6,
      'nom_met_ent_esp'       => 'TresGuerras',
      'url'                   => 'https://www.tresguerras.com.mx/3G/tracking.php',
      'metodo_de_entrega_id'  => 1,
      'created_at_met_ent'    => 'desarrolloweb.ewmx@gmail.com',
    ]);
    MetodoDeEntregaEspecifico::create([
      'id'                    => 7,
      'nom_met_ent_esp'       => 'Aeroméxico',
      'url'                   => 'https://www.aeromexico.com/es-mx/estatus-de-vuelo',
      'metodo_de_entrega_id'  => 1,
      'created_at_met_ent'    => 'desarrolloweb.ewmx@gmail.com',
    ]);
    MetodoDeEntregaEspecifico::create([
      'id'                    => 8,
      'nom_met_ent_esp'       => 'Carssa',
      'url'                   => 'https://www.srenvio.com/rastreo-carssa',
      'metodo_de_entrega_id'  => 1,
      'created_at_met_ent'    => 'desarrolloweb.ewmx@gmail.com',
    ]);
    MetodoDeEntregaEspecifico::create([
      'id'                    => 9,
      'nom_met_ent_esp'       => 'Castores',
      'url'                   => 'https://www.castores.com.mx/rastreo',
      'metodo_de_entrega_id'  => 1,
      'created_at_met_ent'    => 'desarrolloweb.ewmx@gmail.com',
    ]);
    MetodoDeEntregaEspecifico::create([
      'id'                    => 10,
      'nom_met_ent_esp'       => 'DHL',
      'url'                   => 'http://www.dhl.com.mx/es/express/rastreo.html',
      'metodo_de_entrega_id'  => 1,
      'created_at_met_ent'    => 'desarrolloweb.ewmx@gmail.com',
    ]);
    MetodoDeEntregaEspecifico::create([
      'id'                    => 11,
      'nom_met_ent_esp'       => 'Auto',
      'url'                   => null,
      'metodo_de_entrega_id'  => 3,
      'created_at_met_ent'    => 'desarrolloweb.ewmx@gmail.com',
    ]);
    MetodoDeEntregaEspecifico::create([
      'id'                    => 12,
      'nom_met_ent_esp'       => 'Camioneta',
      'url'                   => null,
      'metodo_de_entrega_id'  => 3,
      'created_at_met_ent'    => 'desarrolloweb.ewmx@gmail.com',
    ]);
    MetodoDeEntregaEspecifico::create([
      'id'                    => 13,
      'nom_met_ent_esp'       => 'Paquetería',
      'url'                   => null,
      'metodo_de_entrega_id'  => 4,
      'created_at_met_ent'    => 'desarrolloweb.ewmx@gmail.com',
    ]);
    MetodoDeEntregaEspecifico::create([
      'id'                    => 14,
      'nom_met_ent_esp'       => 'Directo',
      'url'                   => null,
      'metodo_de_entrega_id'  => 4,
      'created_at_met_ent'    => 'desarrolloweb.ewmx@gmail.com',
    ]);
    MetodoDeEntregaEspecifico::create([
      'id'                    => 15,
      'nom_met_ent_esp'       => 'Consolidado',
      'url'                   => null,
      'metodo_de_entrega_id'  => 4,
      'created_at_met_ent'    => 'desarrolloweb.ewmx@gmail.com',
    ]);
    MetodoDeEntregaEspecifico::create([
      'id'                    => 16,
      'nom_met_ent_esp'       => 'iVoy',
      'url'                   => 'https://v2.ivoy.mx/client/app/track/package',
      'metodo_de_entrega_id'  => 1,
      'created_at_met_ent'    => 'desarrolloweb.ewmx@gmail.com',
    ]);
    MetodoDeEntregaEspecifico::create([
      'id'                    => 17,
      'nom_met_ent_esp'       => '99 minutos',
      'url'                   => 'https://99minutos.com/rastreo.html',
      'metodo_de_entrega_id'  => 1,
      'created_at_met_ent'    => 'desarrolloweb.ewmx@gmail.com',
    ]);
    MetodoDeEntregaEspecifico::create([
      'id'                    => 18,
      'nom_met_ent_esp'       => 'SendEx',
      'url'                   => 'http://www.sendex.mx/Rastreo/Rastreo/',
      'metodo_de_entrega_id'  => 1,
      'created_at_met_ent'    => 'desarrolloweb.ewmx@gmail.com',
    ]);
    MetodoDeEntregaEspecifico::create([
      'id'                    => 19,
      'nom_met_ent_esp'       => 'Paqueteexpress',
      'url'                   => 'https://www.paquetexpress.com.mx/',
      'metodo_de_entrega_id'  => 1,
      'created_at_met_ent'    => 'desarrolloweb.ewmx@gmail.com',
    ]);
    MetodoDeEntregaEspecifico::create([
      'id'                    => 20,
      'nom_met_ent_esp'       => 'Redpack',
      'url'                   => 'http://www.redpack.com.mx/rastreo-de-envios/',
      'metodo_de_entrega_id'  => 1,
      'created_at_met_ent'    => 'desarrolloweb.ewmx@gmail.com',
    ]);
  }
}
