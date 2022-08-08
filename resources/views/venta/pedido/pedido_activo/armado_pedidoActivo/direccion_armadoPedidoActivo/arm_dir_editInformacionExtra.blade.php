<label for="redes_sociales">{{ __('INFORMACIÓN EXTRA DEL ARMADO') }}</label>
<div class="border border-primary rounded p-2">
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="tipo_de_tarjeta_de_felicitacion">{{ __('Tipo de tarjeta de felicitación') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-list"></i></span>
        </div>
        {{--  tarjeta de felicitacion  --}}
        @if($direccion->tip_tarj_felic == null)
          {!! Form::select('tipo_de_tarjeta_de_felicitacion', config('opcionesSelect.select_tarjeta_de_felicitacion'), config('opcionesSelect.select_tarjeta_de_felicitacion.Estandar'), ['id' => 'tipo_de_tarjeta_de_felicitacion', 'class' => 'form-control select2' . ($errors->has('tipo_de_tarjeta_de_felicitacion') ? ' is-invalid' : ''), 'placeholder' => __(''), 'onChange' => 'getTipoTarjetaDeFelicitacion();']) !!}
        @else
          {!! Form::select('tipo_de_tarjeta_de_felicitacion', config('opcionesSelect.select_tarjeta_de_felicitacion'), $direccion->tip_tarj_felic, ['id' => 'tipo_de_tarjeta_de_felicitacion', 'class' => 'form-control select2' . ($errors->has('tipo_de_tarjeta_de_felicitacion') ? ' is-invalid' : ''), 'placeholder' => __(''), 'onChange' => 'getTipoTarjetaDeFelicitacion();']) !!}
        @endif 
      </div>
      <span class="text-danger">{{ $errors->first('tipo_de_tarjeta_de_felicitacion') }}</span>
    </div>
    <div id="imagen" >
      <div class="form-group col-sm btn-sm">
        <label for="imagen_de_la_tarjeta">{{ __('Imagen') }}</label>
        @if($direccion->tarj_dise_nom != null)
          <a href="{{ $direccion->tarj_dise_rut.$direccion->tarj_dise_nom }}" download="">{{ __(' - Descargar') }}</a>
        @endif
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-folder-open"></i></span>
          </div> 
         <div class="custom-file"> 
            {!! Form::file('imagen_de_la_tarjeta', ['class' => 'custom-file-input', 'accept' => 'image/jpeg,image/png,image/jpg,image/ico', 'lang' => Auth::user()->lang]) !!}
            <label class="custom-file-label" for="archivo">Max. 1MB</label>
          </div>
          <a href="https://compressjpeg.com/es/" target="_blank" class="btn btn-light border ml-1 p-2" title="Si tu archivo rebasa 1MB comprímela aquí"><i class="fas fa-compress-arrows-alt"></i></a>
        </div>
        <span class="text-danger">{{ $errors->first('imagen_de_la_tarjeta') }}</span>
        {{-- <div class="form-group col-sm btn-sm">
          <center>
            <figure>
              <div id="visualizar-imagen_de_la_tarjeta"></div>
            </figure>
          </center>
        </div> --}}
      </div>
    </div>
    <div id="tarjeta_disenada_por_el_cliente">
      <div class="form-group col-sm btn-sm">
        <label for="tarjeta_disenada_por_el_cliente">{{ __('Tarjeta diseñada por el cliente') }} *</label>
        @if($direccion->tarj_dise_nom != null)
          <a href="{{ $direccion->tarj_dise_rut.$direccion->tarj_dise_nom }}" download="">{{ __('Descargar') }}</a>
        @endif
        <div style="display: none;">
          {!! Form::text('tarjeta_disenada_por_el_cliente_url', $direccion->tarj_dise_rut.$direccion->tarj_dise_nom, ['class' => 'form-control disabled', 'maxlength' => 0, 'readonly' => 'readonly']) !!}
        </div>  
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-folder-open"></i></span>
          </div>
          <div class="custom-file"> 
            {!! Form::file('tarjeta_disenada_por_el_cliente', ['class' => 'custom-file-input', 'lang' => Auth::user()->lang]) !!}
            <label class="custom-file-label" for="archivo">Max. 1MB</label>
          </div>
          <a href="https://compressjpeg.com/es/" target="_blank" class="btn btn-light border ml-1" title="Si tu archivo rebasa 1MB comprímela aquí"><i class="fas fa-compress-arrows-alt"></i></a>
        </div>
        <span class="text-danger">{{ $errors->first('tarjeta_disenada_por_el_cliente') }}</span>
      </div>
    </div>
  </div>
  <div class="row" id="mensaje_de_dedicatoria">
    <div class="form-group col-sm btn-sm">
      <label for="mensaje_de_dedicatoria">{{ __('Mensaje de dedicatoria') }} *<strong>{{ __('Se plasmará tal y como se escriba en este campo') }}</strong></label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::textarea('mensaje_de_dedicatoria',  $direccion->mens_dedic, ['class' => 'form-control' . ($errors->has('mensaje_de_dedicatoria') ? ' is-invalid' : ''), 'maxlength' => 30000, 'placeholder' => __('Mensaje de dedicatoria'), 'rows' => 4, 'cols' => 4]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('mensaje_de_dedicatoria') }}</span>
    </div>
  </div>
</div>

@section('js5')
<script>
  window.onload = function() { 
    getTipoTarjetaDeFelicitacion();
  }
  function getTipoTarjetaDeFelicitacion() {
    // Obtiene los valores de los inputs
    selectTipoDeTarjetaDeFelicitacion = document.getElementById("tipo_de_tarjeta_de_felicitacion"),
    TipoDeTarjetaDeFelicitacion = selectTipoDeTarjetaDeFelicitacion.value;
    tarjeta_disenada_por_el_cliente = document.getElementById('tarjeta_disenada_por_el_cliente');
    mensaje_de_dedicatoria = document.getElementById('mensaje_de_dedicatoria');
    imagen = document.getElementById('imagen');   
    // ---
    
    tarjeta_disenada_por_el_cliente.style.display = 'none';
    mensaje_de_dedicatoria.style.display = 'none';
    imagen.style.display = 'block';

    if(TipoDeTarjetaDeFelicitacion == 'Personalizada') {
      mensaje_de_dedicatoria.style.display = 'block';
    }

    if(TipoDeTarjetaDeFelicitacion == 'Diseñada por el cliente') {
      tarjeta_disenada_por_el_cliente.style.display = 'block';
      imagen.style.display = 'none';
    }
    if(TipoDeTarjetaDeFelicitacion == 'Sin tarjeta' || TipoDeTarjetaDeFelicitacion == 'Entregada por el cliente' || TipoDeTarjetaDeFelicitacion == 'Estandar'){
      imagen.style.display = 'none';
    }
  }
</script>
@endsection