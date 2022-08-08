@if($pago->not != null)
  <span class="badge"><i class="fas fa-exclamation"></i></span>
@endif

@if($pago->comp_de_pag_nom == null)
  <span class="badge" style="background:{{ config('app.color_c') }};color:{{ config('app.color_0') }};">{{ __('Falta cargar comprobante') }}</span>
@endif

@if($pago->form_de_pag == 'Paypal' OR $pago->form_de_pag == 'Tarjeta de credito (Pagina)' AND $pago->cop_de_indent_nom == NULL)
  @if($pago->cop_de_indent_nom == NULL)
    <span class="badge" style="background:{{ config('app.color_c') }};color:{{ config('app.color_0') }};">{{ __('Falta cargar copia de identificación') }}</span>
  @endif
@endif