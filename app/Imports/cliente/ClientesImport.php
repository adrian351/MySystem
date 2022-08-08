<?php
namespace App\Imports\cliente;
use App\User;
use Maatwebsite\Excel\Concerns\ToModel;

class ClientesImport implements ToModel {
    public function model(array $row) {
        return new User([
            'nom'               => $row[0],
            'apell'             => $row[1],
            'email_registro'    => $row[2],
            'email'             => $row[3],
            'email_secund'      => $row[4],
            'lad_fij'           => $row[5],
            'tel_fij'           => $row[6],
            'ext'               => $row[7],
            'lad_mov'           => $row[8],
            'tel_mov'           => $row[9],
            'emp'               => $row[10],
            'obs'               => $row[11],
            'created_at_us'     => $row[12],
        ]);
    }
}