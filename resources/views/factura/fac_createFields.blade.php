<label for="redes_sociales">{{ __('IMPORTANTE') }}</label>
<div class="border border-primary rounded p-2">
  <div class="row">
    <div class="form-group col-sm btn-sm">
        {{ __('Para cualquier duda o aclaración de tu factura comunicarse al teléfono: (0155) 7159 6103 ext. 1002. NOTA: Si no mandas tus datos de facturación antes del 28 del mes en curso se dará por entendido que no vas a requerir factura y no te la podremos generar en fecha posterior.') }}<br>
        <strong>
          {{ __('Tiempo de emisión 72 hrs') }}.<br>
        </strong>
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="cliente">{{ __('Cliente') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('cliente', $clientes, null, ['id' => 'cliente', 'class' => 'form-control select2' . ($errors->has('cliente') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('cliente') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="datos_fiscales">{{ __('Datos fiscales') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('datos_fiscales', [], null, ['id' => 'datos_fiscales', 'class' => 'form-control select2' . ($errors->has('datos_fiscales') ? ' is-invalid' : ''), 'placeholder' => __('Seleccione. . .')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('datos_fiscales') }}</span>
  </div>
</div>



<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
  <div class="btn-group mr-4" role="group" aria-label="First group">
    <label for="datos_fiscales">{{ __('Datos fiscales') }}</label>
  </div>
  <div class="input-group">
    <div class="custom-control custom-switch">
      {!! Form::checkbox('checkbox_datos_fiscales', 'on', true, ['id' => 'checkbox_datos_fiscales', 'class' => 'custom-control-input' . ($errors->has('checkbox_datos_fiscales') ? ' is-invalid' : '')]) !!}
      <label class="custom-control-label" for="checkbox_datos_fiscales">{{ __('Guardar datos fiscales escritos') }}</label>
    </div>
  </div>
</div>


<div class="border border-primary rounded p-2">
  @include('rolCliente.datoFiscal.dfi_createFields')
</div>
<label for="redes_sociales">{{ __('DATOS DE FACTURA') }}</label>
<div class="border border-primary rounded p-2">
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="codigo_de_facturacion">{{ __('Código de facturación') }} ({{ __('Se obtiene al registrar un pago') }}) *</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
          {!! Form::text('codigo_de_facturacion', null, ['id' => 'codigo_de_facturacion', 'class' => 'form-control' . ($errors->has('codigo_de_facturacion') ? ' is-invalid' : ''), 'maxlength' => 50, 'placeholder' => __('Código de facturación')]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('codigo_de_facturacion') }}</span>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="uso_de_cfdi">{{ __('Uso de CFDI') }} *</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
          {!! Form::select('uso_de_cfdi', config('opcionesSelect.select_uso_de_cfdi'), null, ['id' => 'uso_de_cfdi', 'class' => 'form-control select2' . ($errors->has('uso_de_cfdi') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('uso_de_cfdi') }}</span>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="metodo_de_pago">{{ __('Metodo de pago') }} *</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
          {!! Form::select('metodo_de_pago', config('opcionesSelect.select_metodo_de_pago'), null, ['id' => 'select_metodo_de_pago', 'class' => 'form-control select2' . ($errors->has('select_metodo_de_pago') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('metodo_de_pago') }}</span>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="forma_de_pago">{{ __('Forma de pago') }} *</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
          {!! Form::select('forma_de_pago', config('opcionesSelect.select_forma_de_pago_factura'), null, ['id' => 'forma_de_pago', 'class' => 'form-control select2' . ($errors->has('forma_de_pago') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('forma_de_pago') }}</span>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="banco_de_cuenta_de_retiro">{{ __('Banco de cuenta de retiro') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
          {!! Form::text('banco_de_cuenta_de_retiro', null, ['id' => 'banco_de_cuenta_de_retiro', 'class' => 'form-control' . ($errors->has('banco_de_cuenta_de_retiro') ? ' is-invalid' : ''), 'maxlength' => 50, 'placeholder' => __('Banco de cuenta de retiro')]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('banco_de_cuenta_de_retiro') }}</span>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="ultimos_4_digitos_cuenta_de_retiro">{{ __('Últimos 4 dígitos cuenta de retiro') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
          {!! Form::text('ultimos_4_digitos_cuenta_de_retiro', null, ['id' => 'ultimos_4_digitos_cuenta_de_retiro', 'class' => 'form-control' . ($errors->has('ultimos_4_digitos_cuenta_de_retiro') ? ' is-invalid' : ''), 'maxlength' => 4, 'placeholder' => __('Últimos 4 dígitos cuenta de retiro')]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('ultimos_4_digitos_cuenta_de_retiro') }}</span>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="concepto">{{ __('Concepto') }} *</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
          {!! Form::select('concepto', config('opcionesSelect.select_concepto'), null, ['id' => 'concepto', 'class' => 'form-control select2' . ($errors->has('concepto') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('concepto') }}</span>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="comentarios_cliente">{{ __('Comentarios cliente') }} ({{ __('Agregar aquí cualquier comentario adicional ya sea desglose de información etc.') }} )</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::textarea('comentarios_cliente', null, ['class' => 'form-control' . ($errors->has('comentarios_cliente') ? ' is-invalid' : ''), 'maxlength' => 30000, 'placeholder' => __('Comentarios cliente'), 'rows' => 4, 'cols' => 4]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('comentarios_cliente') }}</span>
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <a href="{{ route('usuario.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2"><i class="fas fa-check-circle text-dark"></i> {{ __('Solicitar') }}</button>
  </div>
</div>
@section('js6')
<script>
  $("#cliente").change(function(event){
    $.get("/factura/datos-fiscales-cliente/"+event.target.value+"",function(response,datos_fiscales) {
      $("#datos_fiscales").empty();
      $("#datos_fiscales").append("<option value=''> Seleccione. . .</option>");
      for(i=0; i<response.length; i++) {
        $("#datos_fiscales").append("<option value='"+response[i].id+"'> "+response[i].rfc+"</option>");
      }
    });
  });
  $("#datos_fiscales").change(function(event){
    $.get("/factura/obtener-informacion-dato-fiscal/"+event.target.value+"",function(response,b_rfc) {
      $("#nombre_o_razon_social").val(response.nom_o_raz_soc);
      $("#rfc").val(response.rfc);
      $("#lada_telefono_fijo").val(response.lad_fij);
      $("#telefono_fijo").val(response.tel_fij);
      $("#extension").val(response.ext);
      $("#lada_telefono_movil").val(response.lad_mov);
      $("#telefono_movil").val(response.tel_mov);
      $("#calle").val(response.calle);
      $("#no_exterior").val(response.no_ext);
      $("#no_interior").val(response.no_int);
      $("#pais").val(response.pais);
      $("#ciudad").val(response.ciudad);
      $("#colonia").val(response.col);
      $("#delegacion_o_municipio").val(response.del_o_munic);
      $("#codigo_postal").val(response.cod_post);
      $("#correo").val(response.corr);
    });
  });
</script>
@endsection