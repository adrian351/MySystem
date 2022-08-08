<?php
namespace App\Exports\rolFerro\envio;
use App\Models\PedidoArmadoTieneDireccion;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;


class generarReporteDeEnviosLocalesExport implements FromView {
	use Exportable;
	public function view(): View {
		$consulta = PedidoArmadoTieneDireccion::where('for_loc', 'Local')->where('estat', '!=', config('app.entregado'))->with(['armado' => function($query) {
			$query->with(['pedido']);
		}])->get();

		return view('rolFerro.envio.export.reporteDeEnvios', [
			'envios' => $consulta
		]);
	}
}