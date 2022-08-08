<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="validez">{{ __('Validez') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
      </div>
      {!! Form::date('validez', date("Y-m-d", strtotime('+7 day', strtotime(date("Y-m-d")))), ['class' => 'form-control', 'min' => date('Y-m-d')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('validez') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="cliente">{{ __('Cliente') }} *</label>
    @can('cliente.create')
      <a href="{{ route('cliente.create') }}" class="btn btn-light btn-sm border ml-3 p-1" target="_blank">{{ __('Registrar cliente') }}</a>
    @endcan
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
      </div>
      {!! Form::select('cliente', $clientes_list, null, ['class' => 'form-control select2' . ($errors->has('cliente') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
      </div>
    <span class="text-danger">{{ $errors->first('cliente') }}</span>
  </div>
</div>

{{-- descripcion: quitar campo obligaotrio --}}
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="describe_esta_cotizacion_para_que_sea_mas_facil_encontrarla">{{ __('Describe esta cotización para que sea mas fácil en contrarla') }} </label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('describe_esta_cotizacion_para_que_sea_mas_facil_encontrarla', null, ['class' => 'form-control' . ($errors->has('describe_esta_cotizacion_para_que_sea_mas_facil_encontrarla') ? ' is-invalid' : ''), 'maxlength' => 500, 'placeholder' => __('Describe esta cotización para que sea mas fácil encontrarla'), 'rows' => 4, 'cols' => 4]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('describe_esta_cotizacion_para_que_sea_mas_facil_encontrarla') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <a href="{{ route('cotizacion.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2"><i class="fas fa-check-circle text-dark"></i> {{ __('Crear') }}</button>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')