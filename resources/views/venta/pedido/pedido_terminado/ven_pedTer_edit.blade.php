<div class="card">
  <div class="card-header p-1" id="headingOne">
    <h5 class="mb-0">
      <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        <i class="fas fa-arrow-right"></i>&nbsp;&nbsp;&nbsp;<b>{{ __('Agregar reclamación o comentario') }}</b>
      </button>
    </h5>
  </div>
  <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
    <div class="card-body">
      {!! Form::open(['route' => ['venta.pedidoTerminado.update', Crypt::encrypt($pedido->id)], 'method' => 'patch', 'id' => 'ventaPedidoActivoUpdate', 'files' => true]) !!}
        <div class="row">
          <div class="form-group col-sm btn-sm">
            <label for="estatus">{{ __('Estatus') }} *</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-question"></i></span>
              </div>
              {!! Form::select('estatus', config('opcionesSelect.select_abierto_cerrado'), $pedido->est, ['class' => 'form-control select2' . ($errors->has('estatus') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
            </div>
            <span class="text-danger">{{ $errors->first('estatus') }}</span>
          </div>
          <div class="form-group col-sm btn-sm">
            <label for="tipo">{{ __('Tipo') }} *</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-question"></i></span>
              </div>
              {!! Form::select('tipo', config('opcionesSelect.select_com_o_recl'), $pedido->tip, ['class' => 'form-control select2' . ($errors->has('tipo') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
            </div>
            <span class="text-danger">{{ $errors->first('tipo') }}</span>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-sm btn-sm">
            <label for="comentario_o_reclamacion">{{ __('Comentario o reclamación') }} *</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-text-width"></i></span>
              </div>
              {!! Form::textarea('comentario_o_reclamacion', $pedido->coment_o_reclam, ['class' => 'form-control' . ($errors->has('comentario_o_reclamacion') ? ' is-invalid' : ''), 'maxlength' => 30000, 'placeholder' => __('Comentario o reclamación'), 'rows' => 4, 'cols' => 4]) !!}
            </div>
            <span class="text-danger">{{ $errors->first('comentario_o_reclamacion') }}</span>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-sm btn-sm">
            <center><button type="submit" id="btnsubmit" class="btn btn-info w-50 p-2" onclick="return check('btnsubmit', 'ventaPedidoActivoUpdate', '¡Alerta!', '¿Estás seguro quieres agregar el comentario o reclamación?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Agregar') }}</button></center>
          </div>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>