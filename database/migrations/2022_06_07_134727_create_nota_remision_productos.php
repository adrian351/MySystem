<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotaRemisionProductos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nota_remision_productos', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');   
            $table->string('product', 200)->comment('Producto');
            $table->string('estat',70)->default('Sin confirmar')->comment('Estatus');
            $table->integer('cant_envio')->unsigned()->comment('Cantidad enviada');
            $table->string('alm_sal', 30)->comment('Almacén de salida');
            $table->string('alm_ent', 30)->comment('Almacén de entrada');
            $table->string('per_aprueba', 50)->comment('Persona que aprueba el envio de los productos');
            $table->string('per_lleva', 50)->comment('Persona que lleva los productos');
            $table->string('per_recibe', 50)->comment('Persona que recibe los productos');
            $table->integer('cant_recibida')->unsigned()->comment('Cantidad recibida');
            $table->string('coment', 3000)->comment('Comentario de la nota');
            $table->unsignedBigInteger('producto_id')->comment('Foreign Key producto');
            $table->foreign('producto_id')->references('id')->on('productos');
            $table->string('asignado_not', 75)->comment('Usuario al que se le asigno este registro');
            $table->string('created_at_not', 85)->comment('Correo del usuario que realizo el registro');
            $table->string('updated_at_not', 85)->nullable()->comment('Correo del usuario que realizo la última modificación');
            
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
        Schema::dropIfExists('nota_remision_productos');
    }
}
