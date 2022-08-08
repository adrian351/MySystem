<?php
use Illuminate\Database\Seeder;
use App\Models\Material;

class MaterialTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    factory(Material::class, 70)->create();
    /*
    Material::create([
      'sku'                 => '',
      'des'                 => '',
      'lob'                 => '',
      'produc_lin'          => '',
      'produc_lin_sub_gro'  => '',
      'fam_de_prod'         => '',
      'lin_de_prod'         => '',
      'sub_lin_de_prod'     => '',
      'prec_list_pag'       => '',
      'desc'                => '',
      'prec_pag_al_cli'     => '',
      'asignado_mat'        => '',
      'created_at_mat'      => '',
    ]);
    */
  }
}
