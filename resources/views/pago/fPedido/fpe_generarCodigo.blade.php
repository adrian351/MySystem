@extends('pago.fPedido.fpe_createIndex')
@section('createPago')
  {!! Form::open(['route' => ['pago.fPedido.storeCodigo', Crypt::encrypt($pedido->id)], 'onsubmit' => 'return checarBotonSubmit("btnsubmit")']) !!}
    <div class="row">
      <div class="form-group col-sm btn-sm">
        <label for="monto_del_pago">{{ __('Monto del pago') }} *</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
          </div>
          {!! Form::text('monto_del_pago', null, ['id' => 'monto_del_pago', 'class' => 'form-control' . ($errors->has('monto_del_pago') ? ' is-invalid' : ''), 'maxlength' => 15, 'placeholder' => __('Monto del pago'), 'onChange' => 'getMontoDelPago();']) !!}
          <div class="input-group-append">
            <span class="input-group-text">.00</span>
          </div>
        </div>
        <span class="text-danger">{{ $errors->first('monto_del_pago') }}</span>
      </div>
    </div>

    <div class="row">
      <div class="form-group col-sm btn-sm">
        <label for="comentarios_ventas">{{ __('Comentarios ventas') }}</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-text-width"></i></span>
          </div>
          {!! Form::textarea('comentarios_ventas', null, ['class' => 'form-control' . ($errors->has('comentarios_ventas') ? ' is-invalid' : ''), 'maxlength' => 30000, 'placeholder' => __('Comentarios ventas'), 'rows' => 4, 'cols' => 4]) !!}
        </div>
        <span class="text-danger">{{ $errors->first('comentarios_ventas') }}</span>
      </div>
    </div>


    <div class="row">
      <div class="form-group col-sm btn-sm">
        <a href="{{ route('pago.fPedido.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a>
      </div>
      <div class="form-group col-sm btn-sm">
        <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2"><i class="fas fa-check-circle text-dark"></i> {{ __('Generar') }}</button>
      </div>
    </div>
  {!! Form::close() !!}
@endsection