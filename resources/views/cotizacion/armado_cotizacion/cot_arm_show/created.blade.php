<div id="created">
  <div class="card">
      <h5 class="mb-0 p-1">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseCreated" aria-expanded="false" aria-controls="collapseCreated">
          <i class="fas fa-info-circle"></i>&nbsp;&nbsp;&nbsp;<b>{{ __('OBSERVAR DETALLES DEL REGISTRO') }}</b>
        </button>
      </h5>
    <div id="collapseCreated" class="collapse" aria-labelledby="headingThree" data-parent="#created">
      <div class="card-body">
        <div class="row">
          <div class="form-group col-sm btn-sm">
            <label for="created_at">{{ __('Fecha de registro') }}</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
              </div>
              {!! Form::text('created_at', $armado->created_at, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Fecha de registro'), 'readonly' => 'readonly']) !!}
            </div>
          </div>
          <div class="form-group col-sm btn-sm">
            <label for="created_at_arm">{{ __('Registrado por') }}</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
              </div>
              {!! Form::text('created_at_arm', $armado->created_at_arm, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Registrado por'), 'readonly' => 'readonly']) !!}
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-sm btn-sm">
            <label for="updated_at">{{ __('Fecha última modificación') }}</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
              </div>
              {!! Form::text('updated_at', $armado->updated_at, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Fecha última modificación'), 'readonly' => 'readonly']) !!}
            </div>
          </div>
          <div class="form-group col-sm btn-sm">
            <label for="updated_at_arm">{{ __('Última modificación por') }}</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
              </div>
              {!! Form::text('updated_at_arm', $armado->updated_at_arm, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Última modificación por'), 'readonly' => 'readonly']) !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>