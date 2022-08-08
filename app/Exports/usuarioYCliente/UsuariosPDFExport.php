<?php
namespace App\Exports\usuarioYCliente;
use App\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;


class UsuariosPDFExport implements FromView, ShouldQueue {
	use Exportable;
	private $fecha;

	public function deFecha($fecha) {
		$this->fecha = $fecha;
		return $this;
	}
	
	public function view(): View {
		return view('usuario.generar.usu_gen_PDF', [
			'usuarios' => User::latest()->take(10)->get(),
		]);
	}
	
    public function query() {
        return User::query();
    }
}
