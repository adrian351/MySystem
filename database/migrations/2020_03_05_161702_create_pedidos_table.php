<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->string('serie',20)->comment('Serie');
            $table->string('num_pedido',45)->unique()->comment('Número de pedido');
            $table->string('cot_gen',45)->nullable()->comment('Cotización de la que salio este pedido');
            $table->string('ult_let',4)->default('A')->comment('Última letra');
            $table->integer('tot_de_arm')->default(0)->unsigned()->comment('Total de armados');
            $table->integer('arm_carg')->default(0)->unsigned()->comment('Armados cargados');
            $table->decimal('mont_tot_de_ped',20, 2)->unsigned()->comment('Monto total del pedido');
            $table->enum('urg',config('opcionesSelect.es_pedido_urgente'))->default('No')->comment('Urgente');
            $table->enum('stock',config('opcionesSelect.select_si_no'))->default('No')->comment('¿Es pedido de STOCK?');
            $table->enum('foraneo',config('opcionesSelect.select_si_no'))->default('No')->comment('¿Es foráneo?');
            $table->enum('gratis',config('opcionesSelect.select_si_no'))->default('No')->comment('¿Sera gratis?'); 
            $table->date('fech_de_entreg')->nullable()->comment('Fecha de entrega');
            $table->enum('se_pued_entreg_ant',config('opcionesSelect.select_se_puede_entregar_antes'))->nullable()->comment('¿Se puede entregar antes?');
            $table->integer('cuant_dia_ant')->unsigned()->nullable()->comment('¿Cuántos días antes?'); 
            $table->text('coment_client')->nullable()->comment('Comentarios cliente');
           
            $table->string('estat_vent_gen',100)->default(config('app.falta_informacion_general'))->comment('Estatus de venta 1');
            $table->string('estat_vent_arm',100)->default(config('app.falta_cargar_armados'))->comment('Estatus de venta 2');
            $table->string('estat_vent_dir',100)->default(config('app.falta_asignar_direcciones_armados'))->comment('Estatus de venta 3');
            $table->text('coment_vent')->nullable()->comment('Comentarios venta');
            $table->string('con_iva',3)->default('on')->nullable()->comment('¿Con o sin IVA? on=Si, off=No');
            $table->string('estat_pag',100)->default(config('app.pendiente'))->comment('Estatus de pago');
            $table->string('per_reci_alm',80)->nullable()->comment('Personas que recibe en almacen');
            $table->string('img_firm_rut', 200)->nullable()->comment('Ruta de donde se guardo la imagen');
            $table->string('img_firm', 200)->nullable()->comment('Nombre de la imagen');
            $table->string('estat_alm',100)->default(config('app.pendiente'))->comment('Estatus almacén');
            $table->timestamp('fech_estat_alm')->nullable()->comment('Fecha estatus almacén');
            $table->text('coment_alm')->nullable()->comment('Comentarios Almacen');
            $table->string('lid_de_ped_produc',80)->nullable()->comment('Líder de pedido del producto');
            $table->string('bod',150)->nullable()->comment('Bodega donde se armara el pedido');
            $table->string('estat_produc',100)->default(config('app.pendiente'))->comment('Estatus del producto');
            $table->timestamp('fech_estat_produc')->nullable()->comment('Fecha estatus producto');
            $table->text('coment_produc')->nullable()->comment('Comentarios producción');
            $table->string('estat_log',100)->default(config('app.pendiente'))->comment('Estatus logística');
            $table->timestamp('fech_estat_log')->nullable()->comment('Fecha estatus logística');
            $table->text('coment_log')->nullable()->comment('Comentarios logística');

            $table->string('est', 20)->default('Abierto')->comment('Estatus');
            $table->string('tip', 50)->nullable()->comment('Tipo es reclamación o comentario');
            $table->text('coment_o_reclam')->nullable()->comment('Comentario o reclamo');


            $table->unsignedBigInteger('user_id')->comment('Foreign Key usuario');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('restrict')->onDelete('cascade');
            $table->string('asignado_ped',75)->comment('Correo del usuario al que se le asigno este registro');
            $table->string('created_at_ped',75)->comment('Correo del usuario que realizo el registro');
            $table->string('updated_at_ped',75)->nullable()->comment('Correo del usuario que realizo la última modificación');
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
        Schema::dropIfExists('pedidos');
    }
}
