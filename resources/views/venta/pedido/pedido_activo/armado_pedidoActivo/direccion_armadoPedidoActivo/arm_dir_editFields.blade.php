@if($direccion->armado->estat != config('app.en_ruta'))
  <div class="form-group col-sm btn-sm">
    <label for="direcciones">{{ __('Direcciones') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('direcciones', $direcciones, null, ['id' => 'direcciones', 'class' => 'form-control select2' . ($errors->has('direcciones') ? ' is-invalid' : ''), 'placeholder' => __('Seleccione. . .')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('direcciones') }}</span>
  </div>

  @section('js6')
  <script>
    $("#direcciones").change(function(event){
      $.get("/venta/pedido-activo/armado/direccion/obt-direccion/"+event.target.value+"",function(response) {
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

  @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_editDireccionEntrega')
  <div class="row">
    <div class="form-group col-sm btn-sm" >
      <a href="{{  route('venta.pedidoActivo.armado.edit', Crypt::encrypt($direccion->pedido_armado_id)) }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Continuar con el armado') }}</a>
    </div>
    <div class="form-group col-sm btn-sm">
      <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2" onclick="return check('btnsubmit', 'ventaPedidoActivoArmadoDirecionUpdate', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar dirección') }}</button>
    </div>
  </div>
@endif
@include('layouts.private.plugins.priv_plu_select2')
