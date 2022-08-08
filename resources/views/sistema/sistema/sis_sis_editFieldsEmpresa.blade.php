<label for="redes_sociales">{{ __('EMPRESA') }}</label>
<div class="border border-primary rounded p-2">
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="nombre_de_la_empresa">{{ __('Nombre de la empresa') }} *</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="far fa-building"></i></span>
        </div>
        {!! Form::text('nombre_de_la_empresa', Sistema::datos()->sistemaFindOrFail()->emp, ['class' => 'form-control' . ($errors->has('nombre_de_la_empresa') ? ' is-invalid' : ''), 'maxlength' => 200, 'placeholder' => __('Nombre de la empresa')]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('nombre_de_la_empresa') }}</span>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="nombre_de_la_empresa_abreviado">{{ __('Nombre de la empresa abreviado') }} *</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="far fa-building"></i></span>
        </div>
        {!! Form::text('nombre_de_la_empresa_abreviado', Sistema::datos()->sistemaFindOrFail()->emp_abrev, ['class' => 'form-control' . ($errors->has('nombre_de_la_empresa_abreviado') ? ' is-invalid' : ''), 'maxlength' => 50, 'placeholder' => __('Nombre de la empresa abreviado')]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('nombre_de_la_empresa_abreviado') }}</span>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="year_de_inicio">{{ __('Año de inicio') }} *</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
        </div>
          {!! Form::date('year_de_inicio', Sistema::datos()->sistemaFindOrFail()->year_de_ini, ['class' => 'form-control' . ($errors->has('year_de_inicio') ? ' is-invalid' : ''),'max' => date("Y-m-d")]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('year_de_inicio') }}</span>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="telefono_fijo">{{ __('Teléfono fijo') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-tty"></i></span>
        </div>
        {!! Form::number('lada_telefono_fijo', Sistema::datos()->sistemaFindOrFail()->lad_fij, ['class' => 'form-control' . ($errors->has('lada_telefono_fijo') ? ' is-invalid' : ''), 'min' => 1, 'max' => 9999, 'placeholder' => __('Lada teléfono fijo')]) !!}
        {!! Form::text('telefono_fijo', Sistema::datos()->sistemaFindOrFail()->tel_fij, ['class' => 'form-control' . ($errors->has('telefono_fijo') ? ' is-invalid' : ''), 'maxlength' => 15, 'placeholder' => __('Teléfono fijo')]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('lada_telefono_fijo') }}</span>
      <span class="text-danger">{{ $errors->first('telefono_fijo') }}</span>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="extension">{{ __('Extensión') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-phone"></i></span>
        </div>
        {!! Form::text('extension', Sistema::datos()->sistemaFindOrFail()->ext, ['class' => 'form-control' . ($errors->has('extension') ? ' is-invalid' : ''), 'maxlength' => 10, 'placeholder' => __('Extensión')]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('extension') }}</span>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="telefono_movil">{{ __('Teléfono móvil') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
        </div>
        {!! Form::number('lada_telefono_movil', Sistema::datos()->sistemaFindOrFail()->lad_mov, ['class' => 'form-control' . ($errors->has('lada_telefono_movil') ? ' is-invalid' : ''), 'min' => 1, 'max' => 9999, 'placeholder' => __('Lada teléfono fijo')]) !!}
        {!! Form::text('telefono_movil', Sistema::datos()->sistemaFindOrFail()->tel_mov, ['class' => 'form-control' . ($errors->has('telefono_movil') ? ' is-invalid' : ''), 'maxlength' => 15, 'placeholder' => __('Teléfono móvil')]) !!}
      </div>
      <span class="text-danger">{{ $errors->first('lada_telefono_movil') }}</span>
      <span class="text-danger">{{ $errors->first('telefono_movil') }}</span>
    </div>
  </div>
</div>