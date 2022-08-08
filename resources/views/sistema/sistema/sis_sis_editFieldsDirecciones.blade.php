<label for="redes_sociales">{{ __('DIRECCIONES') }}</label>
  <div class="border border-primary rounded p-2">
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="direccion_uno">{{ __('Dirección uno') }} *</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
        </div>
        {!! Form::text('direccion_uno', Sistema::datos()->sistemaFindOrFail()->direc_uno, ['class' => 'form-control' . ($errors->has('direccion_uno') ? ' is-invalid' : ''), 'maxlength' => 500, 'placeholder' => __('Dirección uno')]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('direccion_uno') }}</span>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="direccion_dos">{{ __('Dirección dos') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
        </div>
        {!! Form::text('direccion_dos', Sistema::datos()->sistemaFindOrFail()->direc_dos, ['class' => 'form-control' . ($errors->has('direccion_dos') ? ' is-invalid' : ''), 'maxlength' => 500, 'placeholder' => __('Dirección dos')]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('direccion_dos') }}</span>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="direccion_tres">{{ __('Dirección tres') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
        </div>
        {!! Form::text('direccion_tres', Sistema::datos()->sistemaFindOrFail()->direc_tres, ['class' => 'form-control' . ($errors->has('direccion_tres') ? ' is-invalid' : ''), 'maxlength' => 500, 'placeholder' => __('Dirección tres')]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('direccion_tres') }}</span>
    </div>
  </div>
</div>