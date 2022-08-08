@if($pedido->urg == 'Si')
  <i class="fas fa-exclamation-triangle" title="{{ __('Urgente') }}"></i>
@endif
@if($pedido->foraneo == 'Si')
  <i class="fas fa-globe-africa" title="{{ __('Foráneo') }}"></i>
  @else
      <i class="fas fa-street-view" title="Local"></i>
@endif
@if($pedido->gratis == 'Si')
  <i class="fas fa-gift" title="{{ __('Gratis') }}"></i>
@endif

@if($pedido->stock == 'Si')
  <i class="fas fa-warehouse" title="{{ __('Pedido de STOCK') }}"></i>
@endif