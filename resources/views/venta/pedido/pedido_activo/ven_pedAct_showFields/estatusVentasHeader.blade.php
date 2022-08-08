<strong>{{ __('Estatus ventas') }}: </strong>
@switch($pedido->estat_vent_gen)
  @case(config('app.informacion_general_completa'))
    <span class="badge" style="background:{{ config('app.color_d') }};">{{ $pedido->estat_vent_gen }}</span> 
    @break
  @case(config('app.falta_informacion_general'))
    <span class="badge" style="background:{{ config('app.color_a') }};color:{{ config('app.color_0') }};">{{ $pedido->estat_vent_gen }}</span> 
    @break
  @default
    {{ $pedido->estat_vent_gen }}
@endswitch

@switch($pedido->estat_vent_arm )
  @case(config('app.armados_cargados'))
    <span class="badge" style="background:{{ config('app.color_d') }};">{{ $pedido->estat_vent_arm }}</span> 
    @break
  @case(config('app.falta_cargar_armados'))
    <span class="badge" style="background:{{ config('app.color_a') }};color:{{ config('app.color_0') }};">{{ $pedido->estat_vent_arm }}</span> 
    @break
  @default
    {{ $pedido->estat_vent_arm }}
@endswitch

@switch($pedido->estat_vent_dir)
  @case(config('app.direccion_de_armados_asignado'))
    <span class="badge" style="background:{{ config('app.color_d') }};">{{ $pedido->estat_vent_dir }}</span> 
    @break
  @case(config('app.falta_asignar_direcciones_armados'))
    <span class="badge" style="background:{{ config('app.color_a') }};color:{{ config('app.color_0') }};">{{ $pedido->estat_vent_dir }}</span> 
    @break
  @default
    {{ $pedido->estat_vent_dir }}
@endswitch