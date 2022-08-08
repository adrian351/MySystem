${{ Sistema::dosDecimales($mont_pag_aprov) }} {{ __('de') }} ${{ Sistema::dosDecimales($pedido->mont_tot_de_ped) }} 

@if($pedido->con_iva == 'on')
  ({{ __('Con IVA') }})
@else
  ({{ __('Sin IVA') }})
@endif