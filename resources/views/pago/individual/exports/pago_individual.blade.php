<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered"> 
    <thead>
      <tr>
        <th>{{ __('COD. FACTURACIÓN') }}</th>
        <th>{{ __('FECHA') }}</th>
        <th>{{ __('NUM. PEDIDO') }}</th>
        <th>{{ __('EST. PAGO') }}</th>
        <th>{{ __('FORM. DE PAGO') }}</th>
        <th>{{ __('MONT. DE PAGO') }}</th>
      </tr>
    </thead>
    <tbody>
      @foreach($pagos as $pago)
        @if($pago->mont_de_pag >= 1)
          <tr title="{{ $pago->cod_fact }}">
            <td>{{ $pago->cod_fact }}</td>
            <td>{{ date('d-m-Y', strtotime($pago->created_at)) }}</td>
            <td>
              {{ $pago->pedido->num_pedido }}
            </td>
            <td>{{ $pago->estat_pag }}</td>
            <td>{{ $pago->form_de_pag }}</td>
            <td>
              {{ $pago->mont_de_pag}}
            </td>
            <td>
              @if($pago->pedido->con_iva == 'on')
                    ({{ __('Con IVA') }})
                    @else
                      ({{ __('Sin IVA') }})
              @endif
            </td>
          </tr>
        @endif
      @endforeach
    </tbody>
  </table>
</div>