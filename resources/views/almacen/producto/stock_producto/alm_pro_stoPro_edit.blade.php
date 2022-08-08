  @can('almacen.producto.edit')
    <div class="col-sm-6">
      <div class="card {{ empty($producto->stock < $producto->min_stock) ? config('app.color_card_primario') : config('app.color_card_warning') }} card-outline card-tabs position-relative bg-white">
        <div class="card-body">
          {!! Form::open(['route' => ['almacen.producto.aumentarStock', Crypt::encrypt($producto->id)], 'method' => 'patch', 'id' => 'almacenProductoAumentarStock']) !!}
          <div class="row">
            <div class="form-group col-sm-4">
              <label for="aumentar_stock_naucalpan" class="col-sm col-form-label">{{ __('Bodega') }}*</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-warehouse"></i></span>
                  </div>
                    <select name="" id="val" class="col-sm select2" aria-label="Default select example" placeholder="Selecciona">
                      <option value=""></option>
                      <option value="nau">Naucalpan</option>
                      <option value="temas">Temas</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-sm" id="a_nau">
              <label for="aumentar_stock_naucalpan" class="col-sm col-form-label">{{ __('Aumentar stock naucalpan') }} ({{ Sistema::dosDecimales($producto->stock) }}) *</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-sort-numeric-up-alt"></i></span>
                  </div>
                    {!! Form::text('aumentar_stock_naucalpan', null, ['class' => 'form-control' . ($errors->has('aumentar_stock_naucalpan') ? ' is-invalid' : ''), 'placeholder' => __('Cantidad')]) !!}

                    <button type="submit" id="btnsubmit1" class="btn btn-info rounded ml-2" title="{{ __('Registrar') }}" onclick="return check('btnsubmit1', 'almacenProductoAumentarStock', '¡Alerta!', '¿Estás seguro quieres aumentar el stock de este producto?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-check-circle text-dark"></i>
                  </button>
                </div>
            </div>
            <div class="form-group col-sm" id="a_temas">
              <label for="aumentar_stock_temas" class="col-sm col-form-label">{{ __('Aumentar stock temas') }} ({{ Sistema::dosDecimales($producto->stock_temas) }})*</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-sort-numeric-up-alt"></i></span>
                </div>
                  {!! Form::text('aumentar_stock_temas', null, ['class' => 'form-control' . ($errors->has('aumentar_stock_temas') ? ' is-invalid' : ''), 'placeholder' => __('Cantidad')]) !!}

                  <button type="submit" id="btnsubmit1" class="btn btn-info rounded ml-2" title="{{ __('Registrar') }}" onclick="return check('btnsubmit1', 'almacenProductoAumentarStock', '¡Alerta!', '¿Estás seguro quieres aumentar el stock de este producto?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-check-circle text-dark"></i>
                  </button>
              </div>
            </div>

            <div class="texto form-group col-sm ml-5" id="texto1">
              <i class="fas fa-info-circle"> {{ __('Selecciona una bodega para aumentar el Stock.') }}</i>
              <div class="input-group">
                <span class="py-2 ml-5">
                  Naucalpan: {{ $producto->stock }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Temas: {{ $producto->stock_temas }}
                </span>
              </div>
            </div>
            
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  @endcan

@section('js5')
<script>
  $('#val').on('change', valor)
  var a_nau = document.getElementById('a_nau');
    a_nau.style.display = 'none';
  var a_temas = document.getElementById('a_temas');
    a_temas.style.display = 'none';
  var texto1 = document.getElementById('texto1');

  function valor(){
    val = document.getElementById('val');
      valor = val.value;

    if(valor == ''){
      texto1.style.display = 'block';
    }else{
        texto1.style.display = 'none';
      }

    if(valor == 'nau'){
      a_nau.style.display = 'block';
      a_temas.style.display = 'none';
    }else if(valor == 'temas'){
      a_temas.style.display = 'block';
      a_nau.style.display = 'none';
    }
  }

  {{--  window.onload = function() { 
    aumentarStock();
  }
  function aumentarStock(){
    a_nau = document.getElementById('a_nau');
      valueNaucalpan = a_nau.value;
      a_temas = document.getElementById('a_temas');
      valueTemas = a_temas.value;
    boton_aumentar = document.getElementById('btnsubmit1');     
    if(valueNaucalpan == '' && valueTemas == ''){
      boton_aumentar.style.display = 'none';
    }else{
      boton_aumentar.style.display = 'block';
    }
  }  --}}
</script>
@endsection

@section('css')
<style>
  .texto{
    font-size: 18px;
    font-family:Arial, Helvetica, sans-serif;
    color:gray;
  }
</style>
@endsection