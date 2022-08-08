<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArmadoTieneImagenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('armado_tiene_imagenes', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->string('img_rut',200)->nullable()->comment('Ruta imágen');
            $table->string('img_nom',200)->nullable()->comment('Nombre imágen');
            $table->unsignedBigInteger('armado_id')->comment('Foreign Key armados');
            $table->foreign('armado_id')->references('id')->on('armados')->onUpdate('restrict')->onDelete('cascade');
            $table->string('created_at_img', 75)->comment('Correo del usuario que realizo el registro');
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
        Schema::dropIfExists('armado_tiene_imagenes');
    }
}
