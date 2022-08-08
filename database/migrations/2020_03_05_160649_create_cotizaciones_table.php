<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotizacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->string('num_pedido_gen',45)->nullable()->comment('Número de pedido generado');
            $table->string('ser',45)->comment('Serie');
            $table->string('serie',45)->unique()->comment('Serie');
            $table->enum('estat', [config('app.abierta'),config('app.aprobada'),config('app.cancelada')])->default('Abierta')->comment('Estatus de la factura');
            $table->date('valid')->comment('Fecha de validez');
        //    $table->string('email_cliente',75)->comment('Correo del cliente que solicita la cotización');
            $table->text('desc_cot')->comment('Descripción de la cotización');
            $table->text('coment')->nullable()->comment('Comentarios');
            $table->text('coment_vent')->nullable()->comment('Comentarios venta');

            $table->integer('tot_arm')->unsigned()->default(0)->comment('Total de armados');
            $table->decimal('cost_env', 20,2)->unsigned()->default(0.00)->comment('Costo de envio');
            $table->decimal('desc',20,2)->unsigned()->default(0.00)->comment('Descuento');
            $table->decimal('sub_total', 20,2)->unsigned()->default(0.00)->comment('Sub total');
            $table->decimal('iva', 20,2)->unsigned()->default(0.00)->comment('IVA');
            $table->string('con_iva',3)->default('on')->nullable()->comment('¿Con o sin IVA? on=Si, off=No');

            $table->decimal('com', 20,2)->unsigned()->default(0.00)->comment('Comisión');
            $table->string('con_com',3)->default(null)->nullable()->comment('¿Con o sin comisión? on=Si, off=No');

            $table->decimal('tot', 20,2)->unsigned()->default(0.00)->comment('Precio total');
            
            $table->unsignedBigInteger('user_id')->comment('Foreign Key usuario');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('restrict')->onDelete('cascade');
            $table->string('asignado_cot', 75)->comment('Correo del usuario al qu se le asigno este registro');
            $table->string('created_at_cot',75)->comment('Correo del usuario que realizo el registro');
            $table->string('updated_at_cot',75)->nullable()->comment('Correo del usuario que realizo la última modificación');
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
        Schema::dropIfExists('cotizaciones');
    }
}
