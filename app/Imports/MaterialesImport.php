<?php
namespace App\Imports;
use App\Models\Material;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class MaterialesImport implements ToModel, WithChunkReading, ShouldQueue {
  use Importable;
  /**
  * @param array $row
  *
  * @return \Illuminate\Database\Eloquent\Model|null
  */
  public function model(array $row) {
    return new Material([
      'sku'                 => $row[0],
      'des'                 => $row[1],
      'lob'                 => $row[2],
      'produc_lin'          => $row[3],
      'produc_lin_sub_gro'  => $row[4],
      'fam_de_prod'         => $row[5],
      'lin_de_prod'         => $row[6],
      'sub_lin_de_prod'     => $row[7],
      'prec_list_pag'       => $row[8],
      'desc'                => $row[9],
      'prec_pag_al_cli'     => $row[10],
    ]);
  }
  public function chunkSize(): int{
    return 1000;
  }
}