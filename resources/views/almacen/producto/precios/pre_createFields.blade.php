<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="ano">{{ __('Año') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-calendar-week"></i></span>
      </div>
      {!! Form::text('ano', null, ['class' => 'form-control' . ($errors->has('ano') ? ' is-invalid' : ''), 'maxlength' => 5, 'placeholder' => __('Año')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('ano') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="precio">{{ __('Precio') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
      {!! Form::text('precio', null, ['id' => 'precio', 'class' => 'form-control' . ($errors->has('precio') ? ' is-invalid' : ''), 'maxlength' => 15, 'placeholder' => __('Precio'), 'onChange' => 'decimales();']) !!}
      <div class="input-group-append">
        <span class="input-group-text">.00</span>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('precio') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <a href="{{ route('almacen.producto.edit', Crypt::encrypt($producto->id)) }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Continuar con el producto') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2"><i class="fas fa-check-circle text-dark"></i> {{ __('Registrar') }}</button>
  </div>
</div>

@include('almacen.producto.alm_pro_calcularUtilidad')
@section('js6')
<script>
  function decimales() {
    // Obtiene los valores de los inputs
    precio = document.getElementById("precio").value;

    // Verifica si los inputs son de tipo float de lo contrario les asigan el valor de 0
    if (isNaN(parseFloat(precio))) {
      precio = 0;
    }

    // Agrega o solo deja dos decimales
    precio_decimal  = Number.parseFloat(precio).toFixed(2);
   
    // Pega el resultado en los inputs
    document.getElementById("precio").value = precio_decimal;

  }
</script>
@endsection