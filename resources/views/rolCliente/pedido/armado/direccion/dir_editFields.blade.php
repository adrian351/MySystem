@if($direccion->armado->estat != config('app.en_produccion') AND $direccion->armado->estat != config('app.en_almacen_de_salida') AND $direccion->armado->estat != config('app.en_ruta') AND $direccion->armado->estat != config('app.sin_entrega_por_falta_de_informacion') AND $direccion->armado->estat != config('app.intento_de_entrega_fallido'))
  @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_editInformacionExtra')
@endif

<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="direcciones">{{ __('Direcciones') }}</label>
    <a href="{{ route('rolCliente.direccion.create') }}" class="btn btn-info btn-sm ml-3 p-1" target="_blank">{{ __('Ver direcciones') }}</a>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('direcciones', $direcciones, null, ['id' => 'direcciones', 'class' => 'form-control select2' . ($errors->has('direcciones') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('direcciones') }}</span>
  </div>
</div>

@include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_editDireccionEntrega')

<div class="row">
  <div class="form-group col-sm btn-sm" >
    <a href="{{  route('rolCliente.pedido.edit', Crypt::encrypt($direccion->armado->pedido_id)) }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Continuar con el pedido') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2" onclick="return check('btnsubmit', 'rolClientePedidoArmadoDireccionUpdate', '¡Alerta!', '¿Estás seguro quieres actualizar el registro? Una vez asignada la dirección ya no podrás cambiarla', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Asignar') }}</button>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')
@section('js6')
<script>
  $("#direcciones").change(function(event){
    $.get("/rc/direccion-de-entrega/obtener/"+event.target.value+"",function(response,b_rfc) {
      $("#nombre_de_la_persona_que_recibe_uno").val(response.nom_ref_uno);
      $("#nombre_de_la_persona_que_recibe_dos").val(response.nom_ref_dos);
      $("#lada_telefono_fijo").val(response.lad_fij);
      $("#telefono_fijo").val(response.tel_fij);
      $("#extension").val(response.ext);
      $("#lada_telefono_movil").val(response.lad_mov);
      $("#telefono_movil").val(response.tel_mov);
      $("#calle").val(response.calle);
      $("#no_exterior").val(response.no_ext);
      $("#no_interior").val(response.no_int);
      $("#pais").val(response.pais);
      $("#colonia").val(response.col);
      $("#delegacion_o_municipio").val(response.del_o_munic);
      $("#codigo_postal").val(response.cod_post);
      $("#referencias_zona_de_entrega").val(response.ref_zon_de_entreg);
    });
  });
</script>
@endsection