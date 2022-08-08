<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotizacionArmadoTieneDireccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizacion_armado_tiene_direcciones', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            
            $table->enum('for_loc', config('opcionesSelect.select_foraneo_local'))->comment('Foráneo o Local');
            $table->string('met_de_entreg',150)->comment('Método de entrega');
            $table->string('met_de_entreg_esp',150)->nullable()->comment('Método de entrega especifico');
            $table->string('cantt', 10)->nullable()->comment('Cantidad de productos');
            $table->string('trans', 100)->nullable()->comment('Transporte');
            $table->string('est', 150)->comment('Estado');
            $table->enum('tot_unit', ['Total','Unitario'])->nullable()->comment('Total o unitario');
            $table->string('mun', 150)->nullable()->comment('Municipio');
            $table->string('tip_env', 80)->nullable()->comment('Tipo de envío');
            $table->enum('tam', config('opcionesSelect.select_tamano'))->comment('Tamaño');
            $table->decimal('cost_tam_caj',20,2)->unsigned()->default(0.00)->comment('Costo del tamaño de la caja');
            $table->enum('seg',config('opcionesSelect.select_si_no'))->comment('Cuenta con seguro');
            $table->string('tiemp_ent', 25)->comment('Tiempo de entrega en dias');
            $table->decimal('cost_por_env',20,2)->unsigned()->comment('Costo por envío');

            $table->decimal('cost_por_env_individual',20,2)->unsigned()->nullable()->comment('Costo por envío venta');
            $table->integer('cant')->unsigned()->default(0)->comment('Cantidad');
            $table->string('detalles_de_la_ubicacion',150)->comment('Detalles de la ubicación');

            $table->unsignedBigInteger('armado_id')->comment('Foreign Key armados cotización');
            $table->foreign('armado_id')->references('id')->on('cotizacion_tiene_armados')->onUpdate('restrict')->onDelete('cascade');
            $table->string('created_at_dir',75)->comment('Correo del usuario que realizo el registro');
            $table->string('updated_at_dir', 75)->nullable()->comment('Correo del usuario que realizo la última modificación');
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
        Schema::dropIfExists('cotizacion_armado_tiene_direcciones');
    }
}
