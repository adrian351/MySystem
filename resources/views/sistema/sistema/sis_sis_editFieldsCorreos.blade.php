<label for="redes_sociales">{{ __('CORREOS') }}</label>
<div class="border border-primary rounded p-2">
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="correo_ventas">{{ __('Correo ventas') }} *</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-envelope"></i></span>
        </div>
        {!! Form::text('correo_ventas', Sistema::datos()->sistemaFindOrFail()->corr_vent, ['class' => 'form-control' . ($errors->has('correo_ventas') ? ' is-invalid' : ''), 'maxlength' => 75, 'placeholder' => __('Correo ventas')]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('correo_ventas') }}</span>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="correo_opcion_uno">{{ __('Correo opción uno') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-envelope"></i></span>
        </div>
        {!! Form::text('correo_opcion_uno', Sistema::datos()->sistemaFindOrFail()->corr_opc_uno, ['class' => 'form-control' . ($errors->has('correo_opcion_uno') ? ' is-invalid' : ''), 'maxlength' => 75, 'placeholder' => __('Correo opción uno')]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('correo_opcion_uno') }}</span>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="correo_opcion_dos">{{ __('Correo opción dos') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-envelope"></i></span>
        </div>
        {!! Form::text('correo_opcion_dos', Sistema::datos()->sistemaFindOrFail()->corr_opc_dos, ['class' => 'form-control' . ($errors->has('correo_opcion_dos') ? ' is-invalid' : ''), 'maxlength' => 75, 'placeholder' => __('Correo opción dos')]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('correo_opcion_dos') }}</span>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="correo_opcion_tres">{{ __('Correo opción tres') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-envelope"></i></span>
        </div>
        {!! Form::text('correo_opcion_tres', Sistema::datos()->sistemaFindOrFail()->corr_opc_tres, ['class' => 'form-control' . ($errors->has('correo_opcion_tres') ? ' is-invalid' : ''), 'maxlength' => 75, 'placeholder' => __('Correo opción tres')]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('correo_opcion_tres') }}</span>
    </div>
  </div>
</div>