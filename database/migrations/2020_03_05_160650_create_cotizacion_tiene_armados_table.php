<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotizacionTieneArmadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizacion_tiene_armados', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_armado');
            
            $table->string('img_rut',200)->nullable()->comment('Ruta imágen');
            $table->string('img_nom',200)->nullable()->comment('Nombre imágen');
            $table->string('tip', 150)->comment('Tipo de armado');
            $table->string('nom',110)->comment('Nombre');
            $table->enum('ya_mod',['0', '1'])->default('0')->comment('¿Armado ya modificado? 0= No, 1=Si');
            $table->string('sku',60)->comment('SKU');
            $table->string('gama', 150)->comment('Gama');
            $table->enum('dest', config('opcionesSelect.select_destacado'))->comment('Destacado');
            
            $table->enum('tam', config('opcionesSelect.select_tamano'))->nullable()->comment('Tamaño');
            $table->decimal('pes',10,3)->unsigned()->comment('Peso');
            $table->decimal('alto', 10, 2)->unsigned()->comment('Alto');
            $table->decimal('ancho', 10, 2)->unsigned()->comment('Ancho');
            $table->decimal('largo', 10, 2)->unsigned()->comment('Largo');
            $table->enum('es_de_regalo', config('opcionesSelect.select_si_no'))->default('No')->comment('Es de regalo');

            $table->integer('cant')->unsigned()->default(1)->comment('Cantidad');
            $table->integer('cant_direc_carg')->unsigned()->default(0)->comment('Cantidad de direcciones cargadas');
            $table->decimal('prec_de_comp',20,2)->unsigned()->default(0.00)->comment('Precio de compra');
            $table->decimal('prec_origin',20,2)->unsigned()->default(0.00)->comment('Precio original');
            $table->decimal('desc_esp',20,2)->unsigned()->default(0.00)->comment('Descuento especial');
            $table->decimal('prec_redond',20,2)->unsigned()->default(0.00)->comment('Precio redondeado');
            $table->decimal('cost_env', 20,2)->unsigned()->default(0.00)->comment('Costo de envio');

            $table->enum('tip_desc', config('opcionesSelect.select_tipo_de_descuento'))->default('Sin descuento')->comment('Tipo de descuento');
            $table->decimal('manu',20,2)->nullable()->unsigned()->default(0.00)->comment('Descuento manual');
            $table->string('porc', 150)->nullable()->comment('Porcentaje');
            $table->decimal('desc',20,2)->unsigned()->default(0.00)->comment('Descuento');
            $table->decimal('sub_total', 20,2)->unsigned()->default(0.00)->comment('Sub total');
            $table->enum('con_iva', ['Con IVA','Sin IVA'])->default('Con IVA')->comment('¿Con o sin IVA?');
            $table->decimal('iva', 20,2)->unsigned()->default(0.00)->comment('IVA');
            $table->decimal('tot', 20,2)->unsigned()->default(0.00)->comment('Precio total');
            
            $table->unsignedBigInteger('cotizacion_id');
            $table->foreign('cotizacion_id')->references('id')->on('cotizaciones')->onUpdate('restrict')->onDelete('cascade');
            $table->string('created_at_arm',75)->nullable()->comment('Correo del usuario que realizo el registro');
            $table->string('updated_at_arm',75)->nullable()->comment('Correo del usuario que realizo la última modificación');
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
        Schema::dropIfExists('cotizacion_tiene_armados');
    }
}
