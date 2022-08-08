<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoArmadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_armados', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->string('cod',50)->comment('Código');
            $table->string('ult_let',4)->default('1')->comment('Última letra');
            $table->string('estat',70)->default('Pendiente')->comment('Estatus');
            $table->integer('cant')->unsigned()->comment('Cantidad');
            $table->enum('for_loc', config('opcionesSelect.select_foraneo_local'))->comment('Foráneo o Local');
            $table->integer('cant_direc_carg')->default(0)->unsigned()->comment('Cantidad de direcciones cargadas');
            $table->string('img_rut',200)->nullable()->comment('Ruta imágen');
            $table->string('img_nom',200)->nullable()->comment('Nombre imágen');
            $table->string('tip', 150)->comment('Tipo de armado');
            $table->string('nom',90)->comment('Nombre');
            $table->string('sku',60)->comment('SKU');
            $table->string('gama', 150)->comment('Gama');
            $table->decimal('prec', 20,2)->unsigned()->comment('Precio');
            $table->enum('tam', config('opcionesSelect.select_tamano'))->nullable()->comment('Tamaño');
            $table->decimal('pes',10,3)->unsigned()->comment('Peso');
            $table->decimal('alto', 10, 2)->unsigned()->comment('Alto');
            $table->decimal('ancho', 10, 2)->unsigned()->comment('Ancho');
            $table->decimal('largo', 10, 2)->unsigned()->comment('Largo');
            $table->enum('es_de_regalo', config('opcionesSelect.select_si_no'))->default('No')->comment('Es de regalo');
            $table->string('aut',9)->default('N/A')->comment('Autorizado');

            $table->text('coment_client')->nullable()->comment('Comentario cliente');
            $table->text('coment_vent')->nullable()->comment('Comentarios ventas');
            $table->text('coment_alm')->nullable()->comment('Comentarios almacén');
            $table->text('coment_produc')->nullable()->comment('Comentarios producción');
            $table->text('coment_log')->nullable()->comment('Comentarios logística');
            $table->string('ubic_rack',50)->nullable()->comment('Ubicación rack');
    //        $table->string('comp_de_pag_env_rut',200)->nullable()->comment('Ruta comprobante de pago envío');
    //        $table->string('comp_de_pag_env_nom',200)->nullable()->comment('Nombre comprobante de pago envío');
    //        $table->decimal('tot_pag_env', 20,2)->nullable()->unsigned()->comment('Total pago de envío'); 
    //        $table->string('comp_art_reg_rut',200)->nullable()->comment('Ruta comprobante articulos regalo');
    //        $table->string('comp_art_reg_nom',200)->nullable()->comment('Ruta comprobante articulos regalo');
            $table->unsignedBigInteger('pedido_id')->comment('Foreign Key pedido');
            $table->foreign('pedido_id')->references('id')->on('pedidos')->onUpdate('restrict')->onDelete('cascade');
            $table->string('created_at_ped_arm',75)->comment('Correo del usuario que realizo el registro');
            $table->string('updated_at_ped_arm',75)->nullable()->comment('Correo del usuario que realizo la última modificación');
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
        Schema::dropIfExists('pedido_armados');
    }
}
