<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->string('prod_valid', 3)->default('No')->comment('¿Producto validado?');
            $table->string('publi_tie_gou', 3)->default('No')->comment('¿Publicado en tienda gourmet?');
            $table->string('hab_desh', 15)->default('Habilitado')->comment('Habilitar o deshabilitar producto');
            $table->string('img_prod_rut', 200)->nullable()->comment('Ruta de donde se guardo la imagen del producto');
            $table->string('img_prod_nom', 200)->nullable()->comment('Nombre de la imagen');
            $table->string('produc', 70)->unique()->comment('Nombre del producto');
            $table->string('pro_de_cat', 100)->comment('Producto de catálogo');
            $table->string('tip_iva', 5)->nullable()->comment('IVA');
            $table->string('ieps', 5)->nullable()->comment('IEPS');
            $table->decimal('min_vent', 20, 2)->nullable()->comment('Mínimo de venta');
            $table->string('cod_fabricante', 100)->nullable()->comment('Código de fabricante');
            $table->string('sku',30)->nullable()->comment('SKU');
            $table->string('marc', 150)->comment('Marca del producto');
            $table->enum('tip', config('opcionesSelect.select_tipo'))->comment('Tipo de producto');
            $table->enum('tam', config('opcionesSelect.select_tamano'))->nullable()->comment('Tamaño');
            $table->decimal('alto', 10, 2)->default(0.00)->unsigned()->comment('Alto de la canasta');
            $table->decimal('ancho', 10, 2)->default(0.00)->unsigned()->comment('Ancho de la canasta');
            $table->decimal('largo', 10, 2)->default(0.00)->unsigned()->comment('Largo de la canasta');
            $table->decimal('cost_arm', 20, 2)->default(0.00)->unsigned()->comment('Costo de armado');
            $table->integer('vend')->default(0)->unsigned()->comment('Productos vendidos');
            $table->integer('cant_requerida')->default(0)->unsigned()->comment('Cantidad vendida');
            $table->integer('min_stock')->nullable()->comment('Stock minimo del producto');
            $table->integer('stock')->default(0)->comment('Stock del producto');
            $table->string('prove', 130)->nullable()->comment('Nombre del proveedor');
            $table->decimal('prec_prove', 20,2)->nullable()->unsigned()->comment('Precio del proveedor');
            $table->enum('utilid', ['.0','.1','.2','.3','.4','.5','.6','.7','.8','.9'])->nullable()->comment('Utilidad .1 = 10%
            .2 =20%, .3 = 30%, .4= 40%, .5 = 50%, .6 = 60%, .7= 70%, .8 = 80%, .9 = 90%');
            $table->decimal('prec_clien', 20,2)->nullable()->unsigned()->comment('Precio al cliente');
            $table->string('categ', 150)->comment('Categoria');
            $table->string('etiq', 150)->nullable()->comment('Etiqueta');
            $table->decimal('pes',10,3)->unsigned()->comment('Peso del producto');
            $table->string('cod_barras', 250)->nullable()->comment('Código de barras');
            $table->text('desc_del_prod')->nullable()->comment('Descripcion del producto');
            $table->string('asignado_prod', 75)->comment('Correo del usuario al que se le asigno este registro');
            $table->string('created_at_prod', 75)->nullable()->comment('correo del usuario que realizo el registro');
            $table->string('updated_at_prod', 75)->nullable()->comment('correo del usuario que realizo la última modificacion');
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
        Schema::dropIfExists('productos');
    }
}
