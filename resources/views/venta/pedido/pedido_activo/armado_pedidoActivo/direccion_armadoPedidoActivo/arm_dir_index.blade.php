<div class="card {{ config('app.color_card_secundario') }}">
  <div class="card-header p-1 bg-dark">
    <div class="row">
      <div class="col-sm-8">
        <div class="input-group-append">
          <h5>
            <strong class="col-sm col-form-label">{{ __('Direcciones') }}</strong>
          </h5>
        </div>
      </div>
      @if(Request::route()->getName() == 'venta.pedidoActivo.armado.edit')
        @can('venta.pedidoActivo.armado.edit')
          @if($armado->cant != $armado->cant_direc_carg)
            <div class="col-sm-2">
              {!! Form::open(['route' => ['venta.pedidoActivo.armado.updateDirecciones', Crypt::encrypt($armado->id)], 'method' => 'patch', 'id' => 'armadoUpdateDirecciones']) !!} 
                  <div class="form-group row justify-content-end m-0">
                    <div class="custom-control custom-switch col-form-label" title="Asigar dirección">
                      {!! Form::checkbox('direccion', 'on', null, ['id' => 'direccion', 'class' => 'custom-control-input' . ($errors->has('direccion') ? ' is-invalid' : ''), 'onclick' => "return check('direccion', 'armadoUpdateDirecciones', '¡Alerta!', 'Le asignarás (Dirección en excel) a todas las direcciones que no estén detalladas. ¿Estás seguro que quieres actualizar los registros?', 'info', 'Continuar', 'Cancelar', 'false');"]) !!}
                      <label class="custom-control-label" for="direccion"><h6>{{ __('Asignar Dirección en excel') }}</h6></label>
                    </div>
                  </div>
                <span class="text-danger">{{ $errors->first('direccion') }}</span>
              {!! Form::close() !!}
            </div> 
          @endif
        
          @if($armado->estat != config('app.en_ruta') AND $armado->estat != config('app.entregado'))
          <div class="col-sm-2">
            <center>
              <button type="button" class="btn text-white" data-toggle="modal" data-target="#exampleModal">
                <h6><i class="fas fa-divide"></i>&nbsp; {{ __('Dividir dirección') }}</h6>
              </button>
            </center>
          
            <div class="modal fade text-dark" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                {!! Form::open(['route' => ['venta.pedidoActivo.armado.dividirDireccion', Crypt::encrypt($armado->id)], 'method' => 'patch', 'id' => 'btnDividirDireccion']) !!}
                <div class="modal-content">
                  <div class="modal-header bg-dark">
                    <h5 class="modal-title" id="exampleModalLabel">Dividir dirección</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="form-group col-sm">
                        <label for="id_direccion" >{{ __('Dirección') }}</label>
                        <div class="input-group-append text-dark">
                          <select name="id_direccion" id="direcciones-list" class="form-control select2"  placeholder="Seleccione"  required></select>
                        </div>
                        <span class="text-danger" id="select-options" style="display:none">Sin resultados</span>
                      </div>
                      <div class="form-group col-sm">
                        <label for="cantidad_dir">{{ __('Cantidad total') }}</label>
                        <div class="input-group">
                          <input type="text" name="cantidad_dir" class="form-control" id="cantidadDir" placeholder="Cantidad" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm">
                        <label for="estado" >{{ __('Estado') }} </label>
                        <div class="input-group-append text-dark">
                          <input type="text" name="estado" id="estado" class="form-control" placeholder="Estado"  readonly></input>   
                        </div>
                      </div>
                      <div class="form-group col-sm">
                        <label for="cant_div" >{{ __('Cantidad a dividir') }} </label>
                        <div class="input-group-append text-dark">
                          <input type="text" name="cant_div" id="cant_div" class="form-control" placeholder="Cantidad a dividir" onkeyup="validarCantidad()" required></input>   
                        </div>
                        <span class="text-danger">{{ $errors->first('cant_div') }}</span>
                        <span class="text-danger" style="display: none" id="mensaje_cantidad_mayor">La cantidad a dividir no puede ser igual o mayor a la cantidad total de esta dirección.</span>
                        <span class="text-danger" style="display: none" id="mensaje_cantidad_menor">La cantidad a dividir no puede ser 0 o menor a 0.</span>
                      </div>
                    </div>


                    <div class="form-group row  m-1">
                      <div class="custom-control custom-switch col-form-label" title="Dividir todo" data-toggle="toggle">
                        {!! Form::checkbox('div_todo', 'on', null, ['id' => 'div_todo', 'class' => 'custom-control-input ' . ($errors->has('div_todo') ? ' is-invalid' : '')]) !!}
                        <label class="custom-control-label" for="div_todo"><h6>{{ __('Dividir todo.') }}</h6></label>
                      </div>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                      <button type="submit" id="btnsubmitDividir" class="btn btn-info" onclick="return check('btnsubmitDividir', 'btnDividirDireccion', '¡Alerta!', 'Se creará un nuevo registro con los datos de esta dirección. ¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');" title="Dividir dirección">{{ __('Dividir') }}</button>
                    </div>
                  </div>
                </div>
                {!! Form::close() !!}
              </div>
            </div>
          </div>
          @endif
        @endcan
      @endif
    </div>
      
      {{--  <h5 class="ml-3">  --}}
      {{--  funcional, comenbtado por su poco uso  --}}
      {{--  <span class="float-right">
        {{ __('Total armados direcciones: ') }}
        @php
          $suma = 0;
        @endphp
          
        @foreach ($armado->direcciones as $dir)
          @php
            $suma += $dir->cant;
          @endphp
        @endforeach
        
        @if ($suma < $armado->cant)
          <span class="badge bg-danger" >{{ $suma }}</span>
          @elseif ($suma == $armado->cant)
            <span class="badge bg-success" >{{ $suma }}</span>
        @endif
        
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        {{ _('Armados: ') }}
        <span class="badge bg-success">
          {{ $armado->cant }}
        </span>
      </span>  --}}
    {{--  </h5>   --}}
  </div>
  <div class="card-body">
    {{--  {{ $armado->direcciones}}  --}}
    @include('venta.pedido.pedido_activo.armado_pedidoActivo.direccion_armadoPedidoActivo.arm_dir_table')
    @include('global.paginador.paginador', ['paginar' => $direcciones]) 
  </div>
</div>

@section('js6')
<script>
  $('#direcciones-list').on('change', onChangeDireccion);
  $('#div_todo').on('change', onChangeTodo);
  
  const direcciones_list = @json($armado->direcciones);  
  var select_direcciones_list = '<option disabled selected>Seleccione</option>';
  var selected_dir = document.getElementById('direcciones-list');
  var dividir_todo = document.getElementById('div_todo');
  var cantidad_a_dividir = document.getElementById('cant_div');
  var cantidad_menor = document.getElementById('mensaje_cantidad_menor');
  var mensaje_cantidad = document.getElementById('mensaje_cantidad_mayor');
  var boton = document.getElementById('btnsubmitDividir');  
      boton.disabled = true;

  //checar si el checbox está activo
  onChangeTodo();

  for(i = 0; i < direcciones_list.length; i++){
    let direccion = direcciones_list[i];
    if(direccion.cant > 1){
      select_direcciones_list += '<option value="'+direccion.id+'" >'+direccion.cod+'</option>';
      $('#direcciones-list').html(select_direcciones_list);
    }
  }
 
  if(selected_dir.value  != 'Seleccione'){
    let select_mensaje = document.getElementById('select-options');
    selected_dir.disabled = true;
    select_mensaje.style.display = 'block';
    dividir_todo.disabled = true;
    cantidad_a_dividir.disabled = true;
  }
  
  function onChangeDireccion(){
    let  cant_dir = document.getElementById('cantidadDir');
    let estado = document.getElementById('estado');
    for(i = 0; i < direcciones_list.length; i++){
      let result = direcciones_list[i];
      if(selected_dir.options[selected_dir.selectedIndex].value == result.id){
        cant_dir.value = result.cant;
        estado.value = result.est;
      }
    }
    validarCantidad();
    onChangeTodo();
  }

  function validarCantidad(){
    let  cantidad = document.getElementById('cant_div');
        cantidad_value = cantidad.value;
    
    for(i = 0; i < direcciones_list.length; i++){
      let resultado = direcciones_list[i];
      if(selected_dir.options[selected_dir.selectedIndex].value == resultado.id){
        let cant = resultado.cant;

        if(cantidad_value >= cant){
          mensaje_cantidad.style.display = 'block';
          cantidad_menor.style.display = 'none';
          boton.disabled = true;
        }else if(cantidad_value <= 0 || cantidad_value == ''){
          cantidad_menor.style.display = 'block';
          mensaje_cantidad.style.display = 'none';
          boton.disabled = true;
        }else{
          mensaje_cantidad.style.display = 'none';
          cantidad_menor.style.display = 'none';
          boton.disabled = false;
          }
      }
    }
  }

  function onChangeTodo(){
    if(dividir_todo.checked){
      cantidad_a_dividir.disabled = true;
      boton.disabled = false;
      cantidad_menor.style.display = 'none';
      cantidad_a_dividir.value = '';
      mensaje_cantidad.style.display = 'none';
    }else{
      cantidad_a_dividir.disabled = false;
      if(cantidad_a_dividir.value == ''){
        boton.disabled = true;
      }
    }
  }

</script>
@endsection