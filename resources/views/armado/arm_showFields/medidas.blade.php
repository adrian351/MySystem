<div id="medidas">
  <div class="card">
      <h5 class="mb-0 p-1">
        <a class="btn btn-link collapsed text-primary" data-toggle="collapse" data-target="#collapseMedidas" aria-expanded="false" aria-controls="collapseMedidas">
          <i class="fas fa-ruler-combined"></i>&nbsp;&nbsp;&nbsp;<b>{{ __('MEDIDAS') }}</b>
        </a>
      </h5>
    <div id="collapseMedidas" class="collapse" aria-labelledby="headingThree" data-parent="#medidas">
      <div class="card-body">
        <div class="border border-primary rounded p-2">
          <div class="row">
            <div class="form-group col-sm btn-sm">
              <label for="tamano">{{ __('Tamaño') }} *</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-text-width"></i></span>
                </div>
                {!! Form::select('tamano', config('opcionesSelect.select_tamano'), $armado->tam, ['class' => 'form-control disabled select2', 'placeholder' => __(''), 'disabled' => 'disabled']) !!}
                </div>
            </div>
            <div class="form-group col-sm btn-sm">
              <label for="alto">{{ __('Alto') }}</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-ruler-horizontal"></i></span>
                </div>
                {!! Form::text('alto', Sistema::dosDecimales($armado->alto), ['class' => 'form-control disabled' . ($errors->has('alto') ? ' is-invalid' : ''), 'maxlength' => 0, 'placeholder' => __('Alto'), 'readonly' => 'readonly']) !!}
                <div class="input-group-prepend">
                  <span class="input-group-text">cm</span>
                </div>
              </div>
              <span class="text-danger">{{ $errors->first('alto') }}</span>
            </div>
            <div class="form-group col-sm btn-sm">
              <label for="ancho">{{ __('Ancho') }}</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-ruler-horizontal"></i></span>
                </div>
                {!! Form::text('ancho', Sistema::dosDecimales($armado->ancho), ['class' => 'form-control disabled' . ($errors->has('ancho') ? ' is-invalid' : ''), 'maxlength' => 0, 'placeholder' => __('Ancho'), 'readonly' => 'readonly']) !!}
                <div class="input-group-prepend">
                  <span class="input-group-text">cm</span>
                </div>
              </div>
              <span class="text-danger">{{ $errors->first('ancho') }}</span>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-sm btn-sm">
              <label for="largo">{{ __('Largo') }}</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-ruler-horizontal"></i></span>
                </div>
                {!! Form::text('largo', Sistema::dosDecimales($armado->largo), ['class' => 'form-control disabled' . ($errors->has('largo') ? ' is-invalid' : ''), 'maxlength' => 0, 'placeholder' => __('Largo'), 'readonly' => 'readonly']) !!}
                <div class="input-group-prepend">
                  <span class="input-group-text">cm</span>
                </div>
              </div>
              <span class="text-danger">{{ $errors->first('largo') }}</span>
            </div>
            <div class="form-group col-sm btn-sm">
              <label for="peso">{{ __('Peso') }}</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-weight"></i></span>
                </div>
                {!! Form::text('peso', Sistema::tresDecimales($armado->pes), ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('peso'), 'readonly' => 'readonly']) !!}
                <div class="input-group-prepend">
                  <span class="input-group-text">Kg</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>