<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactosProveedorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactos_proveedor', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom', 80)->comment('Nombre');
            $table->string('carg', 100)->comment('Cargo');
            $table->string('corr', 75)->nullable()->comment('Correo');
            $table->string('lad_fij', 4)->nullable()->comment('Lada del teléfono fijo');
            $table->string('tel_fij', 15)->nullable()->comment('Teléfono fijo');
            $table->string('ext', 10)->nullable()->comment('Extensión');
            $table->string('lad_mov', 4)->comment('Lada del teléfono móvil');
            $table->string('tel_mov', 15)->comment('Teléfono móvil');
            $table->text('obs')->nullable()->comment('Observaciones');
            $table->unsignedBigInteger('proveedor_id');
            $table->foreign('proveedor_id')->references('id')->on('proveedores')->onUpdate('restrict')->onDelete('cascade');
            $table->string('created_at_prov_cont', 75)->comment('Correo del usuario que realizo el registro');
            $table->string('updated_at_prov_cont', 75)->nullable()->comment('Correo del usuario que realizo la última modificación');
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
        Schema::dropIfExists('contactos_proveedor');
    }
}
