<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotizacionArmadoTieneProductosTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('cotizacion_armado_tiene_productos', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_producto')->comment('id del producto');
            $table->integer('cant')->unsigned()->comment('Cantidad de productos');
            $table->string('produc', 70)->comment('Nombre del producto');
            $table->string('sku',30)->comment('SKU');

            $table->string('marc', 70)->comment('Marca del producto');
            $table->enum('tip', config('opcionesSelect.select_tipo'))->comment('Tipo de producto');
            $table->enum('tam', config('opcionesSelect.select_tamano'))->nullable()->comment('Tamaño');
            $table->decimal('alto', 10, 2)->default(0.00)->unsigned()->comment('Alto de la canasta');
            $table->decimal('ancho', 10, 2)->default(0.00)->unsigned()->comment('Ancho de la canasta');
            $table->decimal('largo', 10, 2)->default(0.00)->unsigned()->comment('Largo de la canasta');
            $table->decimal('cost_arm', 20, 2)->default(0.00)->unsigned()->comment('Costo de armado');
            $table->string('prove', 130)->comment('Nombre del proveedor');
            $table->decimal('prec_prove', 20,2)->unsigned()->comment('Precio del proveedor');
            $table->enum('utilid', ['.0','.01','.02','.03','.04','.05','.06','.07','.08','.09','.1','.11','.12','.13','.14','.15','.16','.17','.18','.19','.2','.21','.22','.23','.24','.25','.26','.27','.28','.29','.3','.31','.32','.33','.34','.35','.36','.37','.38','.39','.4','.41','.42','.43','.44','.45','.46','.47','.48','.49','.5','.51','.52','.53','.54','.55','.56','.57','.58','.59','.6','.61','.62','.63','.64','.65','.66','.67','.68','.69','.7','.71','.72','.73','.74','.75','.76','.77','.78','.79','.8','.81','.82','.83','.84','.85','.86','.87','.88','.89','.9'])->comment('Utilidad .1 = 10%
            .2 =20%, .3 = 30%, .4= 40%, .5 = 50%, .6 = 60%, .7= 70%, .8 = 80%, .9 = 90%');
            $table->decimal('prec_clien', 20,2)->unsigned()->comment('Precio al cliente');
            $table->string('categ', 150)->comment('Categoria');
            $table->string('etiq', 150)->nullable()->comment('Etiqueta');
            $table->decimal('pes',10,3)->unsigned()->comment('Peso del producto');
            $table->string('cod_barras', 250)->nullable()->comment('Código de barras');

            $table->unsignedBigInteger('armado_id');
            $table->foreign('armado_id')->references('id')->on('cotizacion_tiene_armados')->onUpdate('restrict')->onDelete('cascade');
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
        Schema::dropIfExists('cotizacion_armado_tiene_productos');
    }
}
