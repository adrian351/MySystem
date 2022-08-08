  <div class="col-sm">
      <div class="card-body">
        <center>
          <button type="button" class="btn btn-outline-dark p-2 w-50 m-0" data-toggle="modal" data-target="#exampleModalCenter" title="Mover productos de bodega a bodega">
            <i class="fas fa-warehouse " style="font-size: 1.5em;"></i>&nbsp;
            <i class="fas fa-exchange-alt " style="font-size: 1.5em;"></i>&nbsp;
            <i class="fas fa-warehouse" style="font-size: 1.5em;"></i>&nbsp;&nbsp;&nbsp;
              <span style="font-size: 1.2em;">{{ __('Mover productos de almacén') }}</span>
          </button>
        </center>
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            {!! Form::open(['route' => ['almacen.producto.nota.store', Crypt::encrypt($producto->id)], 'onsubmit' => 'return checarBotonSubmit("btnsubmitNota")']) !!}
            <div class="modal-content">
              <div class="modal-header bg-info">
                <h5 class="nota modal-title" id="exampleModalLongTitle">{{ __('Nota de Remisión') }}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <div class="producto row" >
                  <span class="m-3">
                    {{ $producto->produc }}
                  </span>
                </div> 
                <div class="row">
                  <div class="form-group col-sm">
                    <div class="input-group">
                      {!! Form::hidden('producto', $producto->produc , ['class' => 'form-control hidden' . ($errors->has('producto') ? ' is-invalid' : ''), 'placeholder' => __('Producto'), 'readonly' => 'readonly']) !!}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm">
                    <label for="producto_id" class="col-sm col-form-label">{{ __('Id') }} </label>
                      <div class="input-group">
                        {!! Form::text('producto_id', $producto->id , ['class' => 'form-control' . ($errors->has('producto_id') ? ' is-invalid' : ''), 'placeholder' => __('Producto_id'), 'readonly' => 'readonly']) !!}
                      </div>
                  </div>
                  <div class="form-group col-sm">
                    <label for="cantidad" class="col-sm col-form-label">{{ __('Cantidad') }} </label>
                    <div class="input-group">
                      {!! Form::text('cantidad', null, ['class' => 'form-control' . ($errors->has('cantidad') ? ' is-invalid' : ''), 'id' => 'notaCant', 'placeholder' => __('Cantidad'), 'required' => 'true']) !!}
                    </div>
                    <span class="text-danger">{{ $errors->first('cantidad') }}</span>
                    <span class="text-danger" style="display: none" id="mensaje">No puedes enviar más productos de los existentes en stock.</span>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group col-sm">
                    <label for="alm_sal" class="col-sm col-form-label">{{ __('Almacén de salida') }} </label>
                    <div class="input-group">
                      {!! Form::select('alm_sal', config('opcionesSelect.select_bodega'), null, ['id' => 'almacen_salida', 'class' => 'form-control select2' . ($errors->has('alm_sal') ? ' is-invalid' : ''), 'placeholder' => __(''), 'required' => 'true']) !!}
                    </div>
                    <span class="text-danger">{{ $errors->first('alm_sal') }}</span>
                  </div>
                  <div class="form-group col-sm">
                    <label for="alm_ent" class="col-sm col-form-label">{{ __('Almacén de entrada') }} </label>
                    <div class="input-group">
                      <input type="text" name="alm_ent" id="almacen_entrada" class="form-control" placeholder="{{ __('Almacén de entrada') }}" readonly required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm">
                    <label for="per_aprueba" class="col-sm col-form-label">{{ __('Persona que aprueba') }} </label>
                    <div class="input-group">
                      {!! Form::text('per_aprueba', null, ['class' => 'form-control' . ($errors->has('per_envia') ? ' is-invalid' : ''), 'placeholder' => __('Persona que aprueba'), 'required' => 'true']) !!}
                    </div>
                    <span class="text-danger">{{ $errors->first('per_aprueba') }}</span>
                  </div>
                  <div class="form-group col-sm">
                    <label for="per_lleva" class="col-sm col-form-label">{{ __('Persona que traslada') }} </label>
                    <div class="input-group">
                      {!! Form::text('per_lleva', null, ['class' => 'form-control' . ($errors->has('per_recibe') ? ' is-invalid' : ''), 'placeholder' => __('Persona que traslada'), 'required' => 'true']) !!}
                    </div>
                    <span class="text-danger">{{ $errors->first('per_lleva') }}</span>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group col-sm">
                    <label for="coment" class="col-sm col-form-label">{{ __('Comentario') }} </label>
                    <div class="input-group">
                      {!! Form::textarea('coment', null, ['class' => 'form-control', 'maxlength' => 30000, 'placeholder' => __('Comentario'), 'rows' => 2, 'cols' => 4]) !!}
                    </div>
                    <span class="text-danger">{{ $errors->first('coment') }}</span>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-md btn-danger" data-dismiss="modal">{{ __('Cerrar') }}</button>
                <button type="submit" id="btnsubmitNota" class="btn btn-md btn-info" style="display: block">{{ __('Generar') }}</button>
              </div>
            </div>
            {!! Form::close() !!}
          </div>
        </div> 
      </div>
  </div>

@section('js4')
<script>
  $('#almacen_salida').on('change', bodegaDeSalida)
  $('#notaCant').on('change', notaCantidad)

  const pro = @json($producto);
  function bodegaDeSalida(){
    almacen_salida = document.getElementById('almacen_salida');
      almacen_salida_val = almacen_salida.value;

    if(almacen_salida_val == 'Naucalpan'){
      notaCantidad();
      $('#almacen_entrada').val('Temas');

    }else if(almacen_salida_val == 'Temas'){
        notaCantidad();
        $('#almacen_entrada').val('Naucalpan');
      }
  }

  function notaCantidad(){
    cantidad_producto = document.getElementById('notaCant');
      cantidad_producto_val = cantidad_producto.value;

    almacen_salida = document.getElementById('almacen_salida');
      almacen_salida_val = almacen_salida.value;
      
    mensaje = document.getElementById('mensaje');
    boton = document.getElementById('btnsubmitNota');

    if(almacen_salida_val == 'Naucalpan'){
      result0 = pro.stock - cantidad_producto_val;
      
      if(result0 < 0){
        mensaje.style.display = 'block';
        boton.disabled = true;
      }else{
        mensaje.style.display = 'none';
        boton.disabled = false;
      }  
    }

    if(almacen_salida_val == 'Temas'){
      result1 = pro.stock_temas - cantidad_producto_val;
     
      if(result1 < 0){
        mensaje.style.display = 'block';
        boton.disabled = true;
      }else{
        mensaje.style.display = 'none';
        boton.disabled = false;
      }  
    }
  }
</script>
@endsection

@section('css2')
<style>
    .nota{
      font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
      font-size: 2em;
    }

    .producto{
      font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
      font-size: 1.5em;
      align-items: center;
      display: flex;
      height: 100px;
      justify-content: center;
      background-color:rgb(0, 0, 0);
      color:white;
      border-radius: 10px;
    }
    
</style>
@endsection
