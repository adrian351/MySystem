{!! Form::open(['route' => ['cotizacion.armado.store', Crypt::encrypt($cotizacion->id)], 'onsubmit' => 'return checarBotonSubmit("btnCotizacionArmadoStore")', 'class' => 'col-sm  float-right']) !!}
 {{--  agregar armados segun la marca seleccionada  --}}
  <div class=" form-group row p-0 m-0">
    <div class="form-group col-sm-2">
      <label for="marcas" >{{ __("Marca") }}</label>
      <div class="input-group-append text-dark">
        <select name="marca" id="select-marca" class="form-control select col-sm" placeholder="Seleccione...">
          <option  disabled> Seleccione una marca</option>
            @foreach ($marcas_list as  $marcas)
              <option value="{{ $marcas->id }}">{{ $marcas->marca }}</option>
            @endforeach
          <option value="">Personalizados</option>
        </select>
      </div>
    </div>
    <div class="col-sm-1">
      <label for="usar_stock" >{{ __('¿Usar de stock?') }} </label>
      <div class="input-group-append text-dark">
        {!! Form::select('usar_stock', config('opcionesSelect.select_si_no'), 'No', ['id' => 'stockArmado', 'class' => 'form-control select2' . ($errors->has('stock') ? ' is-invalid' : ''), 'placeholder' => __('Seleccione')]) !!}  
      </div>
      <span class="text-danger">{{ $errors->first('usar_stock') }}</span>
    </div>
    <div class="form-group col-sm-6">
      <label for="armados" >{{ __('Armado') }} </label>
      <div class="input-group-append text-dark">
        <select  name="id_armado" id="select-armado" class="form-control select2"></select>   
      </div>
      <span class="text-danger">{{ $errors->first('id_armado') }}</span>
    </div>
    <div class="form-group col-sm-1">
      <label for="cantidad_stock">{{ __('Stock') }}</label>
      <div class="input-group">
        <input type="text" name="cantidad_stock" class="form-control" id="cantidadStock" value="" readonly>
      </div>
    </div>
    <div class="form-group col-sm-2">
      <br/>
      <div class="form-group" style="margin: 6px;">
        <center>
          <button type="submit"  id="btnCotizacionArmadoStore" class="btn btn-success w-50 p-2" title="{{ __('Agregar') }}">{{ __("Agregar") }}</button>
        </center>
      </div>
    </div>
  </div>
{!! Form::close() !!}

@section('js5')
<script>
  $('#select-marca').on('change', onChangeSelectMarca);
  $('#select-armado').on('change', onChangeSelectArmado);

  const armados = @json($armados_list); //array de armados
  var select_todos ='<option value="">Seleccione</option>';
  var selected = document.getElementById('select-armado');

  for(i = 0; i < armados.length; i++){  //recorremos el array de armados
    var data = armados[i];
    if(data.arm_de_cat == 'No'){
      sku = data.sku == null ? '' : data.sku;
      select_todos += '<option value="'+data.id+'">'+data.nom+' ('+sku+')</option>';      
    }
  };
  getArmados(11);

  function getArmados(marca_id){
    $.get('/marca/'+marca_id+'', function(data){ //ruta: /marca/'+marca_id+'/
      var html_select = '<option value="" label="">Seleccione</option>';
      for(i = 0; i < data.length; i++){
        var datos = data[i]; //almacenamos la data(armados) en una variable
        if(datos.arm_de_cat == 'Si'){ //mostramos solo los arcones que sean de catalogos.
          sku = datos.sku == null ? '' : datos.sku;
          html_select += '<option value="'+datos.id+'" >'+datos.nom+' ('+sku+') stock:'+datos.stock+'</option>'; //si todo esta bien, pintamos las opciones
          $('#select-armado').html(html_select);//le agregamos la lista de opciones a select de armados
        }
      }
    });
  }
  
  function onChangeSelectMarca(){
    $('#select-armado').html("");
    var marca_id = $(this).val();
    //si la marca es diferente pasamos todos los armados que no son de catalogo
    if(!marca_id){ ///personalizados
      $('#select-armado').html(select_todos);
      return false;
    }
    getArmados(marca_id);
  };

  function onChangeSelectArmado(){
    var cant_stock = document.getElementById('cantidadStock');
    //cant_stock.value = selected.options[selected.selectedIndex].value;
    for(i = 0; i < armados.length; i++){
      var result = armados[i];
      if(selected.options[selected.selectedIndex].value == result.id){
        cant_stock.value = result.stock;
      }
    }
  }
</script>
@endsection