<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoImagenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_imagenes', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->string('img_rut',200)->comment('Ruta imágen');
            $table->string('img_nom',200)->comment('Nombre imágen');
            $table->unsignedBigInteger('producto_id')->comment('Foreign Key');
            $table->foreign('producto_id')->references('id')->on('productos')->onUpdate('restrict')->onDelete('cascade');
            $table->string('created_at_reg', 75)->comment('Correo del usuario que realizo el registro');
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
        Schema::dropIfExists('producto_imagenes');
    }
}
