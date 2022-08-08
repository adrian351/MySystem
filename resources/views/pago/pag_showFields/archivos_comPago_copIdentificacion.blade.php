<div class="row">
  @if($pago->comp_de_pag_nom != null)
    <div class="form-group col-sm btn-sm">
      <a href="{{ $pago->comp_de_pag_rut.$pago->comp_de_pag_nom }}" class="btn btn-info border text-dark" target="_blank"><i class="fas fa-search-plus"></i></a>
      <label for="comprobante_de_pago">{{ __('Comprobante de pago') }}</label>
      <div class="pad box-pane-right no-padding" style="min-height: 280px">
        <iframe src="{{ $pago->comp_de_pag_rut.$pago->comp_de_pag_nom }}" style="width:100%;border:none;height:25rem;"></iframe>
      </div>
    </div>
  @else
    <div class="col-md-5">
      <div class="pad box-pane-right no-padding border" style="min-height:280px">
        <span class="badge" style="background:{{ config('app.color_c') }};color:{{ config('app.color_0') }};">{{ __('Falta cargar comprobante') }}</span>
      </div>
    </div>
  @endif

  @if($pago->form_de_pag == 'Paypal' OR $pago->form_de_pag == 'Tarjeta de credito (Pagina)')
    @if($pago->cop_de_indent_nom != NULL)
      <div class="form-group col-sm btn-sm">
        <a href="{{ $pago->cop_de_indent_rut.$pago->cop_de_indent_nom }}" class="btn btn-info border text-dark" target="_blank"><i class="fas fa-search-plus"></i></a>
        <label for="copia_de_identificacion">{{ __('Copia de identificación') }}</label>
        <div class="pad box-pane-right no-padding" style="min-height: 280px">
          <iframe src="{{ $pago->cop_de_indent_rut.$pago->cop_de_indent_nom }}" style="width:100%;border:none;height:25rem;"></iframe>
        </div>
      </div>
    @else
      <div class="col-md-5">
        <div class="pad box-pane-right no-padding border" style="min-height:280px">
          <span class="badge" style="background:{{ config('app.color_c') }};color:{{ config('app.color_0') }};">{{ __('Falta cargar copia de identificación') }}</span>
        </div>
      </div>
    @endif
  @endif
</div>