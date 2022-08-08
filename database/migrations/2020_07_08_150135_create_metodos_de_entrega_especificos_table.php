<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetodosDeEntregaEspecificosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metodos_de_entrega_especificos', function (Blueprint $table) {
          $table->engine ='InnoDB';
          $table->charset = 'utf8mb4';
          $table->collation = 'utf8mb4_unicode_ci';
          $table->bigIncrements('id');

          $table->string('nom_met_ent_esp',150)->comment('Nombre del metodo de entrega especifico');
          $table->string('url',200)->nullable()->comment('URL rastreo');
          $table->unsignedBigInteger('metodo_de_entrega_id')->comment('Foreign Key');
          $table->foreign('metodo_de_entrega_id')->references('id')->on('metodos_de_entrega')->onUpdate('restrict')->onDelete('cascade');

          $table->string('created_at_met_ent',75)->nullable()->comment('Correo del usuario que realizo el registro');
          $table->string('updated_at_met_ent',75)->nullable()->comment('Correo del usuario que realizo la última modificación');
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
        Schema::dropIfExists('metodos_de_entrega_especificos');
    }
}
