<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->string('cod_fact',50)->unique()->comment('Código de facturación');
            $table->string('fol',50)->nullable()->comment('Folio del comprobante de pago');
            $table->string('comp_de_pag_rut',200)->nullable()->comment('Ruta de comprobante de pagos');
            $table->string('comp_de_pag_nom',200)->nullable()->comment('Nombre de comprobante de pagos');
            $table->string('cop_de_indent_rut',200)->nullable()->comment('Ruta de la copia de identificación');
            $table->string('cop_de_indent_nom',200)->nullable()->comment('Nombre de la copia de identificación');
            $table->enum('estat_pag',[config('app.pendiente'), config('app.aprobado'), config('app.rechazado')])->default('Pendiente')->nullable()->comment('Estatus de pago');
            $table->string('user_aut',75)->nullable()->comment('Correo del usuario que autorizo el pago');
            $table->string('est_fact',100)->default(config('app.no_solicitada'))->comment('Estatus factura');
            $table->decimal('mont_de_pag',20,2)->unsigned()->comment('Monto de pago');
            $table->enum('form_de_pag',config('opcionesSelect.select_forma_de_pago'))->nullable()->comment('Forma de pago');
            $table->text('coment_pag_vent')->nullable()->comment('Comentarios del pago por parte de ventas');
            $table->text('coment_pag')->nullable()->comment('Comentarios pagos');
            $table->text('not')->nullable()->comment('Nota del pago para indicar que primero se genera factura y despues pago');
            $table->unsignedBigInteger('pedido_id')->comment('Foreign Key del código de factura');
            $table->foreign('pedido_id')->references('id')->on('pedidos')->onUpdate('restrict')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->comment('Foreign Key usuario');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('restrict')->onDelete('cascade');
            $table->string('created_at_pag',75)->nullable()->comment('Correo del usuario que realizo el registro');
            $table->string('updated_at_pag',75)->nullable()->comment('Correo del usuario que realizo la última modificación');
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
        Schema::dropIfExists('pagos');
    }
}
