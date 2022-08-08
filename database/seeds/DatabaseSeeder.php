<?php
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->call([
        PermisosTableSeeder::class,
        RolesTableSeeder::class,
        UsersTableSeeder::class,
        QuejasYSugerenciasTableSeeder::class,
        QuejaYSugerenciaArchivoTableSeeder::class,
        CatalogosTableSeeder::class,
        SeriesTableSeeder::class,
        PlantillasTableSeeder::class,
        SistemaTableSeeder::class,
      // MÓDULOS
        ProveedoresTableSeeder::class,
        ContactosProveedoresTableSeeder::class,
        ProductosTableSeeder::class,
        ProductoTieneProveedoresTableSeeder::class,
        ProductoTieneSustitutosTableSeeder::class,
        ArmadosTableSeeder::class,
        ArmadoTieneProductosTableSeeder::class,
        MetodosDeEntregaTableSeeder::class,
        MetodosDeEntregaEspecificosTableSeeder::class,
        TiposDeEnvioTableSeeder::class,
        EstadoTableSeeder::class,
        CostosDeEnvioTableSeeder::class,
        CotizacionesTableSeeder::class,
        DireccionesTableSeeder::class,
        DatosFiscalesTableSeeder::class,
        PedidosTableSeeder::class,
        PedidoArmadosTableSeeder::class,
        PedidoArmadoTieneProductosTableSeeder::class,
        PedidoArmadoTieneDireccionesTableSeeder::class,
        PagosTableSeeder::class,
        FacturasTableSeeder::class,
        SoportesTableSeeder::class,
        InventarioEquiposTableSeeder::class,
        InventarioEquipoArchivoTableSeeder::class,
        HistorialesTableSeeder::class,
        SoporteArchivosTableSeeder::class,
        HistorialesArchivosTableSeeder::class,
        MaterialTableSeeder::class,
        ManualesTableSeeder::class,
      ]);
    }
}
