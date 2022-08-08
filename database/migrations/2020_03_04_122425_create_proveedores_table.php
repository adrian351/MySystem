<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('prov_valid', 3)->default('No')->comment('¿Proveedor validado?');
            $table->string('ops', 25)->nullable()->comment('Opción');
            $table->string('cant_min_comp', 25)->nullable()->comment('Cantidad o monto mínimo de compra');
            $table->string('marc', 60)->nullable()->comment('Marca');
            $table->string('arch_rut', 200)->nullable()->comment('Ruta de donde se guardo el archivo');
            $table->string('arch_nom', 200)->nullable()->comment('Nombre del archivo');
            $table->string('raz_soc', 60)->unique()->comment('Razón social');
            $table->string('nom_comerc', 100)->unique()->comment('Nombre comercial');
            $table->enum('fab_distri', config('opcionesSelect.select_fabricante_distribuidor_index'))->comment('Fabricante o distribuidor');
            $table->string('rfc', 40)->nullable()->comment('RFC');
            $table->string('nom_rep_legal', 80)->nullable()->comment('Nombre del representante legal');
            $table->string('pag_web', 100)->nullable()->comment('Página web');
            $table->string('lad_fij', 4)->nullable()->comment('Lada del teléfono fijo');
            $table->string('tel_fij', 15)->nullable()->comment('Teléfono fijo');
            $table->string('ext', 10)->nullable()->comment('Extensión');
            $table->string('lad_mov', 4)->nullable()->comment('Lada del teléfono móvil');
            $table->string('tel_mov', 15)->nullable()->comment('Teléfono móvil');
            $table->text('obs')->nullable()->comment('Observaciones');
            $table->string('call', 45)->comment('Calle y número');
            $table->string('no_ext', 8)->comment('Número exterior');
            $table->string('no_int', 30)->nullable()->comment('Número interior');
            $table->string('pais', 40)->nullable()->comment('Pais');
            $table->string('ciudad', 50)->comment('Ciudad');
            $table->string('col', 40)->comment('Colonia');
            $table->string('del_o_munic', 50)->comment('Delegación o municipio');
            $table->string('cod_post', 6)->comment('Codigo postal');
            $table->text('ref')->nullable()->comment('Referencias');
            $table->string('asignado_prov', 75)->comment('Correo del usuario al qu se le asigno este registro');
            $table->string('created_at_prov', 75)->comment('Correo del usuario que realizo el registro');
            $table->string('updated_at_prov', 75)->nullable()->comment('Correo del usuario que realizo la última modificación');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proveedores');
    }
}
