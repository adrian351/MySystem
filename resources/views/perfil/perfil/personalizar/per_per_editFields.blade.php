<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="idioma">{{ __('Idioma') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-language"></i></span>
      </div>
      {!! Form::select('idioma', config('opcionesSelect.select_idioma'), Auth::user()->lang, ['class' => 'form-control select2' . ($errors->has('idioma') ? ' is-invalid' : '')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('idioma') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="color_barra_de_navegacion">{{ __('Color barra de navegación') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-paint-roller"></i></span>
      </div>
      {!! Form::select('color_barra_de_navegacion', config('opcionesSelect.select_color_barra_de_navegacion'), Auth::user()->col_barr_de_naveg, ['class' => 'form-control select2' . ($errors->has('color_barra_de_navegacion') ? ' is-invalid' : '')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('color_barra_de_navegacion') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="color_barra_lateral_oscura_o_clara">{{ __('Color barra lateral oscura o clara') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-paint-roller"></i></span>
      </div>
      {!! Form::select('color_barra_lateral_oscura_o_clara', config('opcionesSelect.select_color_barra_lateral_oscura_o_clara'), Auth::user()->col_barr_lat_oscu_o_clar, ['class' => 'form-control select2' . ($errors->has('color_barra_lateral_oscura_o_clara') ? ' is-invalid' : '')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('color_barra_lateral_oscura_o_clara') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="color_logotipo">{{ __('Color logotipo') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-paint-roller"></i></span>
      </div>
      {!! Form::select('color_logotipo', config('opcionesSelect.select_color_logotipo'), Auth::user()->col_logot, ['class' => 'form-control select2' . ($errors->has('color_logotipo') ? ' is-invalid' : '')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('color_logotipo') }}</span>
  </div>
</div>
<div class="form-group row">
  <div class="offset-sm-2 col-sm-10">
    <center><button type="submit" id="btnsubmit" class="btn btn-info w-75 p-2" onclick="return check('btnsubmit', 'perfilPersonalizarUpdate', '¡Alerta!', '¿Estás seguro quieres actualizar tu información?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-save text-dark"></i> {{ __('Guardar') }}</button></center>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')