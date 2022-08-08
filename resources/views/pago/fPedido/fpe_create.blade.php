@extends('pago.fPedido.fpe_createIndex')
@section('createPago')
  {!! Form::open(['route' => ['pago.fPedido.store', Crypt::encrypt($pedido->id)], 'onsubmit' => 'return checarBotonSubmit("btnsubmit")', 'files' => true]) !!}
    @include('pago.fPedido.fpe_createFields')
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
        <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2"><i class="fas fa-check-circle text-dark"></i> {{ __('Registrar') }}</button>
      </div>
    </div>
  {!! Form::close() !!}
@endsection