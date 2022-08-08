<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="nombre_de_la_plantilla">{{ __('Nombre de la plantilla') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-brush"></i></span>
      </div>
       {!! Form::text('nombre_de_la_plantilla', $plantilla->nom, ['class' => 'form-control' . ($errors->has('nombre_de_la_plantilla') ? ' is-invalid' : ''), 'maxlength' => 100, 'placeholder' => __('Nombre de la plantilla')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('nombre_de_la_plantilla') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
      <label for="modulo">{{ __('Módulo') }} *</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-list"></i></span>
        </div>
        {!! Form::select('modulo', config('opcionesSelect.select_modulo'), $plantilla->mod, ['class' => 'form-control disabled', 'disabled']) !!}
      </div>
    </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="asunto">{{ __('Asunto') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
       {!! Form::text('asunto', $plantilla->asunt, ['class' => 'form-control' . ($errors->has('asunto') ? ' is-invalid' : ''), 'maxlength' => 100, 'placeholder' => __('Asunto')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('asunto') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="diseno_de_la_plantilla">{{ __('Diseño de la plantilla') }} *</label>
    <div class="input-group">
       {!! Form::textarea('diseno_de_la_plantilla', $plantilla->dis_de_la_plant, ['class' => 'form-control textarea' . ($errors->has('diseno_de_la_plantilla') ? ' is-invalid' : '')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('diseno_de_la_plantilla') }}</span>
  </div>
</div>
<hr>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <a href="{{ route('sistema.plantilla.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2" onclick="return check('btnsubmit', 'sistemaPlantillaUpdate', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar') }}</button>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_summernote')
@section('js1')
<script>  
  otros = [
    // SISTEMA
    '$nombre_de_la_empresa !', 
    '$nombre_de_la_empresa_abreviado !', 
    '$telefono_fijo !',
    '$extension !', 
    '$telefono_movil !', 
    '$direccion_uno !', 
    '$correo_ventas !', 
    '$year_de_inicio_de_la_empresa !', 
    '$pagina_web_de_la_empresa !', 
    '$pagina_de_inicio_del_sistema !', 
    '$year_actual !',
  ];

  @if($plantilla->mod == config('opcionesSelect.select_modulo.Usuarios (Bienvenida)') OR $plantilla->mod == config('opcionesSelect.select_modulo.Clientes (Bienvenida)'))
    otros.push('$nombre_completo_del_usuario !', 
                '$nombre_del_usuario !', 
                '$apellido_del_usuario !', 
                '$email_registro_del_usuario !',
                '$password !');
  @endif

  @if($plantilla->mod == config('opcionesSelect.select_modulo.Sistema (Restablecimiento de contraseña)'))
    otros.push('$nombre_completo_del_usuario !', 
                '$nombre_del_usuario !', 
                '$apellido_del_usuario !', 
                '$email_registro_del_usuario !',
                '$minutos !',
                '$url_cambio_de_password !');
  @endif

  @if($plantilla->mod == config('opcionesSelect.select_modulo.Perfil (Cambio de contraseña)'))
    otros.push('$nombre_completo_del_usuario !', 
                '$nombre_del_usuario !', 
                '$apellido_del_usuario !', 
                '$email_registro_del_usuario !');
  @endif

  @if($plantilla->mod == config('opcionesSelect.select_modulo.Cotizaciones (Términos y condiciones)'))
  //  otros.push(); // ESTE MÓDULO NO CUENTA CON OPCIONES EXTRAS
  @endif

  @if($plantilla->mod == config('opcionesSelect.select_modulo.Ventas (Registrar pedido)'))
    otros.push('$numero_de_pedido !');
  @endif

  @if($plantilla->mod == config('opcionesSelect.select_modulo.Ventas (Pedido cancelado)'))
  //  otros.push();
  @endif

  @if($plantilla->mod == config('opcionesSelect.select_modulo.Pagos (Registrar pago)'))
    otros.push('$codigo_de_factura !',
              '$monto_del_pago !',
              '$forma_de_pago !',
              '$numero_de_pedido !');
  @endif

  @if($plantilla->mod == config('opcionesSelect.select_modulo.Pagos (Pago rechazado)'))
  otros.push('$codigo_de_factura !',
              '$monto_del_pago !',
              '$forma_de_pago !',
              '$comentarios_del_pago !',
              '$numero_de_pedido !');
  @endif

  @if($plantilla->mod == config('opcionesSelect.select_modulo.Facturación (Factura generada)'))
    otros.push('$id_factura !');
  @endif

  @if($plantilla->mod == config('opcionesSelect.select_modulo.Facturación (Factura cancelada)'))
    otros.push('$id_factura !');
  @endif

  @if($plantilla->mod == config('opcionesSelect.select_modulo.Facturación (Error del cliente)'))
    otros.push('$id_factura !',
              '$comentarios_admin !');
  @endif

  @if($plantilla->mod == config('opcionesSelect.select_modulo.Logística (Pedido entregado)'))
    otros.push('$numero_de_pedido !');
  @endif

  $('.textarea').summernote({
    tabsize: 4,
    height: 500,
    width: 1500,
    @if(Auth::user()->lang == 'es') lang: "es-ES", @endif
    hint: {
      match: /\B@(\w*)$/,
      search: function (keyword, callback) {
        callback($.grep(otros, function (item) {
          return item.indexOf(keyword) == 0;
        }));
      },
      content: function (item) {
        return ' {!! ' + item + '!} ';
      }    
    },
    toolbar: [
      [ 'style', [ 'style' ] ],
      [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
      [ 'fontname', [ 'fontname' ] ],
      [ 'fontsize', [ 'fontsize' ] ],
      [ 'color', [ 'color' ] ],
      [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
      [ 'table', [ 'table' ] ],
      [ 'insert', [ 'link'] ],
      [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
    ]
  });
</script>
@endsection