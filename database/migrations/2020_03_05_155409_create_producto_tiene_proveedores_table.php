<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoTieneProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_tiene_proveedores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('prec_prove', 20,2)->unsigned()->comment('Precio del proveedor');
            $table->enum('utilid', ['.0','.1','.2','.3','.4','.5','.6','.7','.8','.9'])->comment('Utilidad .1 = 10%
            .2 =20%, .3 = 30%, .4= 40%, .5 = 50%, .6 = 60%, .7= 70%, .8 = 80%, .9 = 90%');
            $table->decimal('prec_clien', 20,2)->unsigned()->comment('Precio al cliente');
            $table->string('produc', 70)->nullable()->comment('Nombre del producto que maneja el proveedor');
            $table->string('cod_fabricante', 100)->nullable()->comment('Código de fabricante');
            $table->string('tip_iva', 5)->nullable()->comment('IVA');
            $table->string('ieps', 5)->nullable()->comment('IEPS');
            $table->unsignedBigInteger('proveedor_id')->comment('Foreign Key proveedores');
            $table->unsignedBigInteger('producto_id')->comment('Foreign Key productos');
            $table->foreign('proveedor_id')->references('id')->on('proveedores')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign('producto_id')->references('id')->on('productos')->onUpdate('restrict')->onDelete('cascade');
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
        Schema::dropIfExists('producto_tiene_proveedores');
    }
}
