<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="nombre_del_proveedor">{{ __('Nombre del proveedor') }} *</label>
    @can('proveedor.create')
      <a href="{{ route('proveedor.create') }}" class="btn btn-light btn-sm border ml-3 p-1" target="_blank">{{ __('Registrar proveedor') }}</a>
    @endcan
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::select('nombre_del_proveedor', $proveedores_list, null, ['class' => 'form-control select2' . ($errors->has('nombre_del_proveedor') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('nombre_del_proveedor') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="precio_proveedor">{{ __('Precio final del proveedor') }} ({{ __('Inpuestos incluidos, IVA, IEPS, ETC.') }}) *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
      {!! Form::text('precio_proveedor', null, ['id' => 'precio_proveedor', 'class' => 'form-control' . ($errors->has('precio_proveedor') ? ' is-invalid' : ''), 'maxlength' => 15, 'placeholder' => __('Precio proveedor'), 'onChange' => 'calcularUtilidadSimple();']) !!}
      <div class="input-group-append">
        <span class="input-group-text">.00</span>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('precio_proveedor') }}</span>
  </div>
  <div class="form-group col-sm-1 btn-sm">
    <label for="iva"></label>
    <div class="input-group p-2">
      <div class="custom-control custom-switch">
        {!! Form::checkbox('iva', 'on', null, ['id' => 'iva', 'class' => 'custom-control-input' . ($errors->has('iva') ? ' is-invalid' : '')]) !!}
        <label class="custom-control-label" for="iva">{{ __('IVA') }}</label>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('iva') }}</span>
  </div>
  <div class="form-group col-sm-2 btn-sm">
    <label for="ieps"></label>
    <div class="input-group p-2">
      <div class="custom-control custom-switch">
        {!! Form::checkbox('ieps', 'on', null, ['id' => 'ieps', 'class' => 'custom-control-input' . ($errors->has('ieps') ? ' is-invalid' : '')]) !!}
        <label class="custom-control-label" for="ieps">{{ __('IEPS') }}</label>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('ieps') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="utilidad">{{ __('Utilidad') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
      {!! Form::select('utilidad', config('opcionesSelect.select_utilidad'), '.4', ['id' => 'utilidad', 'class' => 'form-control select2' . ($errors->has('utilidad') ? ' is-invalid' : ''), 'placeholder' => __(''), 'onChange' => 'calcularUtilidadSimple();']) !!}
    </div>
    <span class="text-danger">{{ $errors->first('utilidad') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="precio_cliente">{{ __('Precio cliente') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
      {!! Form::text('precio_cliente', null, ['id' => 'precio_cliente', 'class' => 'form-control disabled' . ($errors->has('precio_cliente') ? ' is-invalid' : ''), 'placeholder' => __('Precio cliente'), 'readonly' => 'readonly']) !!}
    </div>
    <span class="text-danger">{{ $errors->first('precio_cliente') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="mombre_del_producto_que_maneja_el_proveedor">{{ __('Nombre del producto que maneja el proveedor') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></i></span>
      </div>
      {!! Form::text('mombre_del_producto_que_maneja_el_proveedor', null, ['class' => 'form-control' . ($errors->has('mombre_del_producto_que_maneja_el_proveedor') ? ' is-invalid' : ''), 'maxlength' => 70, 'placeholder' => __('Nombre del producto que maneja el proveedor')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('mombre_del_producto_que_maneja_el_proveedor') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="codigo_de_fabricante">{{ __('Código de fabricante') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></i></span>
      </div>
      {!! Form::text('codigo_de_fabricante', null, ['class' => 'form-control' . ($errors->has('codigo_de_fabricante') ? ' is-invalid' : ''), 'maxlength' => 100, 'placeholder' => __('Código de fabricante')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('codigo_de_fabricante') }}</span>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')
@include('almacen.producto.alm_pro_calcularUtilidad')
@section('js6')
<script>
  function calcularUtilidadSimple() {
    // Obtiene los valores de los inputs
    precio_proveedor = document.getElementById("precio_proveedor").value;
    selectUtilidad = document.getElementById("utilidad"),
    utilidad = selectUtilidad.value;

    // Verifica si los inputs son de tipo float de lo contrario les asigan el valor de 0
    if (isNaN(parseFloat(precio_proveedor))) {
      precio_proveedor = 0;
    }

    // Agrega o solo deja dos decimales
    precio_proveedor_decimal  = Number.parseFloat(precio_proveedor).toFixed(2);

    // Calcula la utilidad
    precio_cliente = calculaUtilidad( parseFloat(precio_proveedor_decimal), parseFloat(utilidad), parseFloat(0.00));

    precio_cliente    = Number.parseFloat(precio_cliente).toFixed(2);
    // Pega el resultado en los inputs
    document.getElementById("precio_proveedor").value = precio_proveedor_decimal;
    document.getElementById("precio_cliente").value = precio_cliente;
  }
</script>
@endsection