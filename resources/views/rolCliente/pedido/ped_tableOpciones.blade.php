<td title="Da click para ver los detalles del pedido" id="ver">
  <a href="{{ route('rolCliente.pedido.show', Crypt::encrypt($pedido->id)) }}" title="Detalles: {{ $pedido->num_pedido }}" class="ver btn">
    {{--  <i class="fas fa-eye"></i>    --}}
    {{ __(' Detalles') }}</a>
</td>
<td title="Detallar pedido: {{ $pedido->num_pedido }}">
  @if($pedido->estat_vent_arm == config('app.armados_cargados') AND $pedido->estat_vent_dir == config('app.direccion_de_armados_asignado'))
    <span class="b badge" style="background:{{ config('app.color_d') }}">{{ config('app.direcciones_detalladas') }}</span>
  @else
    <a href="{{ route('rolCliente.pedido.edit', Crypt::encrypt($pedido->id)) }}" class='direccion btn'><i class="fas fa-edit"></i> {{ __('Asignar direcciones') }}</a>
   
    @foreach ($pedido->armados as $a)
       @php
        $arm = $a;
      @endphp
        @if($arm->cant == $arm->cant_direc_carg)
          {{--  <span class="badge" style="background:{{ config('app.color_d') }}">{{ config('app.direcciones_detalladas') }}</span>  --}}
        @else
          <span class="b badge" style="background:{{ config('app.color_c') }};color:{{ config('app.color_0') }};">{{ config('app.falta_detallar_direccion') }}</span>
        @endif
    @endforeach
  @endif
</td>

@section('css')
<style>
  .ver {
    display: flex;
    align-items: center;
    justify-content: center;
    list-style: none;
    text-align: center;
    color: black;
    margin-right: 5px;
    font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    border-radius: 10px;
    background:rgb(255, 255, 255);
    box-shadow: inset 4px 4px 6px -1px rgba(0, 0, 0, 0.2),
                inset -4px -4px 6px -1px rgba(255,255,255,0.7),
                -0.5px -0.5px 0 rgb(255, 255, 255),
                0.5px 0.5px 0 rgba(0,0,0,0.15),
                0px 12px 10px -10px rgba(0,0,0,0.05);
    border: 1px solid rgba(0,0,0,0.01);
  }

 .direccion{
  //display: flex;
  align-items: center;
  justify-content: center;
  list-style: none;
  text-align: center;
  color: black;
  font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  margin-right: 5px;
  border-radius: 10px;
  background: rgb(255, 255, 255);
  box-shadow: inset 4px 4px 6px -1px rgba(0,0,0,0.2),
                inset -4px -4px 6px -1px rgba(255,255,255,0.7),
                -0.5px -0.5px 0 rgba(255,255,251),
                0.5px 0.5px 0 rgba(0,0,0,0.15),
                0px 12px 10px -10px rgba(0,0,0,0.05);
  border: 1px solid rgba(0,0,0,0.01);
 }

 .b{
  align-items: center;
  justify-content: center;
  list-style: none;
  text-align: center;
  margin-right: 5px;
  border-radius: 5px;
 
 }
</style>
@endsection
@section('js5')
<script>
  $('#ver').tooltip('show');
    
</script>
@endsection