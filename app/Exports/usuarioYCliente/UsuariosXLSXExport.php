<?php
namespace App\Exports\usuarioYCliente;
use App\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;


class UsuariosXLSXExport implements FromView, ShouldQueue {
	use Exportable;
	// private $fecha;

	// public function deFecha($fecha) {
	// 	$this->fecha = $fecha;
	// 	return $this;
	// }
	
	// public function view(): View {
	// 	return view('usuario.generar.usu_gen_XLSX', [
	// 		'usuarios' => User::get(),
	// 	]);
	// }
	
    // public function query() {
    //     return User::query();
    // }
     

	public function view(): View {
		return view('usuario.exports.usu_export', [
			'usuarios' => User::get(),
		]);
	}
}
