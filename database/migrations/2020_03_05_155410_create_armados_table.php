<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArmadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('armados', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->string('img_rut',200)->nullable()->comment('Ruta imágen');
            $table->string('img_nom',200)->nullable()->comment('Nombre imágen');
            $table->string('img_rut_min',200)->nullable()->comment('Ruta imágen minimizada');
            $table->string('img_nom_min',200)->nullable()->comment('Nombre imágen minimizada');
            $table->enum('clon',['0','1'])->default('1')->comment('0=No 1=Si');
            $table->integer('num_clon')->unsigned()->default(0)->comment('Número de clon');
            $table->string('tip', 150)->comment('Tipo de armado');
            $table->string('nom',90)->unique()->comment('Nombre');
            $table->string('sku',60)->unique()->comment('SKU');
            $table->string('gama', 150)->comment('Gama');
            // $table->string('arm_de_cat',10)->comment('Armado de catalogo');
            $table->enum('dest', config('opcionesSelect.select_destacado'))->comment('Destacado')->default('No');
            $table->decimal('prec_de_comp',20,2)->unsigned()->default(0.00)->comment('Precio de compra');
            $table->decimal('prec_origin',20,2)->unsigned()->default(0.00)->comment('Precio original');
            $table->decimal('desc_esp',20,2)->unsigned()->default(0.00)->comment('Descuento especial');
            $table->decimal('prec_redond',20,2)->unsigned()->default(0.00)->comment('Precio redondeado');
            $table->string('url_pagina', 150)->nullable()->comment('URL página');
            $table->enum('tam', config('opcionesSelect.select_tamano'))->nullable()->comment('Tamaño');
            $table->decimal('pes',10,3)->default(0.000)->unsigned()->comment('Peso');
            $table->decimal('alto', 10, 2)->default(0.00)->unsigned()->comment('Alto');
            $table->decimal('ancho', 10, 2)->default(0.00)->unsigned()->comment('Ancho');
            $table->decimal('largo', 10, 2)->default(0.00)->unsigned()->comment('Largo');
            $table->text('obs')->nullable()->comment('Observaciones');
            $table->string('asignado_arm', 75)->comment('Correo del usuario al qu se le asigno este registro');
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
        Schema::dropIfExists('armados');
    }
}
