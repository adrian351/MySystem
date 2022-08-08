<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
      Schema::create('materiales', function (Blueprint $table) {
        $table->engine ='InnoDB';
        $table->charset = 'utf8mb4';
        $table->collation = 'utf8mb4_unicode_ci';
        $table->bigIncrements('id');
        $table->string('sku',30)->nullable()->comment('SKU');
        $table->text('des')->nullable()->comment('Descripción');
        $table->string('lob',30)->nullable()->comment('Lob');
        $table->string('produc_lin',50)->nullable()->comment('Product Line');
        $table->string('produc_lin_sub_gro',50)->nullable()->comment('Product Line Sub-Group');
        $table->string('fam_de_prod',60)->nullable()->comment('Familia de producto');
        $table->string('lin_de_prod',60)->nullable()->comment('Linea de producto');
        $table->string('sub_lin_de_prod',60)->nullable()->comment('Sub Linea de producto');
        $table->string('prec_list_pag', 22)->nullable()->comment('Precio Lista Pagina');
        $table->string('desc', 22)->nullable()->comment('Descuento');
        $table->string('prec_pag_al_cli', 22)->nullable()->comment('Precio Pagina (Al cliente)');
        $table->string('asignado_mat', 75)->nullable()->comment('Correo del usuario al qu se le asigno este registro');
        $table->string('created_at_mat',75)->nullable()->comment('Correo del usuario que realizo el registro');
        $table->string('updated_at_mat',75)->nullable()->comment('Correo del usuario que realizo la última modificación');
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
        Schema::dropIfExists('materiales');
    }
}
