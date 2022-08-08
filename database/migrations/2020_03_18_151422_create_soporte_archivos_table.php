<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoporteArchivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('soporte_archivos', function (Blueprint $table) {
        $table->engine ='InnoDB';
        $table->charset = 'utf8mb4';
        $table->collation = 'utf8mb4_unicode_ci';
        $table->bigIncrements('id');
        $table->string('arc_rut', 200)->nullable()->comment('Ruta de donde se guardo el archivo');
        $table->string('arc_nom', 200)->nullable()->comment('Nombre archivo');
        $table->unsignedBigInteger('soporte_id')->comment('Llave foranea a soportes');
        $table->foreign('soporte_id')->references('id')->on('soportes')->onUpdate('restrict')->onDelete('cascade');
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
        Schema::dropIfExists('soporte_archivos');
    }
}
