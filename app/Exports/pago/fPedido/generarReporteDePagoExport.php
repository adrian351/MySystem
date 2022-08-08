<?php
namespace App\Exports\pago\fPedido;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
// Models
use App\Models\Pedido;

class generarReporteDePagoExport implements FromView {
    use Exportable;
    public function view(): View {
        return view('pago.fPedido.exports.fpe_generarReporteDePago', [
            'pedidos' => Pedido::withCount(['pagos AS mont_pagado' => function ($query) {
                $query->select(\DB::raw("SUM(mont_de_pag)"))->where('estat_pag', config('app.aprobado'));
              }
            ])->orderBy('id', 'DESC')->get()
        ]);
    }
}