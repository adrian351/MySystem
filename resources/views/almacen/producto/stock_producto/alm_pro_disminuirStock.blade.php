  @can('almacen.producto.disminuirStock')
    <div class="col-sm-6">
      <div class="card {{ empty($producto->stock < $producto->min_stock) ? config('app.color_card_primario') : config('app.color_card_warning') }} card-outline card-tabs position-relative bg-white" >
        <div class="card-body">
          {!! Form::open(['route' => ['almacen.producto.disminuirStock', Crypt::encrypt($producto->id)], 'method' => 'patch', 'id' => 'almacenProductoDisminuirStock']) !!}
            <div class="row">
              <div class="form-group col-sm-4">
                <label for="aumentar_stock_naucalpan" class="col-sm col-form-label">{{ __('Bodega') }}*</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-warehouse"></i></span>
                    </div>
                      <select name="" id="val1" class="col-sm select2" aria-label="Default select example" placeholder="Selecciona">
                        <option value=""></option>
                        <option value="nau">Naucalpan</option>
                        <option value="temas">Temas</option>
                      </select>
                  </div>
              </div>
              <div class="form-group col-sm" id="d_nau">
                <label for="disminuir_stock_naucalpan" class="col-sm col-form-label">{{ __('Disminuir stock naucalpan') }} ({{ Sistema::dosDecimales($producto->stock) }}) *</label>
                <div class="form-group col-sm">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-sort-numeric-down-alt"></i></span>
                    </div>
                    {!! Form::text('disminuir_stock_naucalpan', null, ['class' => 'form-control' . ($errors->has('disminuir_stock_naucalpan') ? ' is-invalid' : ''), 'placeholder' => __('Cantidad')]) !!}
                    <button type="submit" id="btnsubmit2" class="btn btn-info rounded ml-2" title="{{ __('Registrar') }}" onclick="return check('btnsubmit2', 'almacenProductoDisminuirStock', '¡Alerta!', '¿Estás seguro quieres disminuir el stock de este producto?', 'info', 'Continuar', 'Cancelar', 'false');" ><i class="fas fa-check-circle text-dark"></i></button>
                  </div>
                </div>
              </div>
              <div class="form-group col-sm" id="d_temas">
                <label for="disminuir_stock_temas" class="col-sm col-form-label">{{ __('Disminuir stock temas') }} ({{ Sistema::dosDecimales($producto->stock_temas) }})*</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-sort-numeric-up-alt"></i></span>
                  </div>
                    {!! Form::text('disminuir_stock_temas', null, ['class' => 'form-control' . ($errors->has('disminuir_stock_temas') ? ' is-invalid' : ''), 'placeholder' => __('Cantidad')]) !!}
  
                    <button type="submit" id="btnsubmit2" class="btn btn-info rounded ml-2" title="{{ __('Registrar') }}" onclick="return check('btnsubmit2', 'almacenProductoDisminuirStock', '¡Alerta!', '¿Estás seguro quieres disminuir el stock de este producto?', 'info', 'Continuar', 'Cancelar', 'false');" ><i class="fas fa-check-circle text-dark"></i></button>
                </div>
              </div>
              <div class="texto form-group col-sm ml-5" id="texto2">
                <i class="fas fa-info-circle"> {{ __('Selecciona una bodega para disminuir el Stock.') }}</i>
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

@section('js6')
<script>
  $('#val1').on('change', valor1)
  var d_nau = document.getElementById('d_nau');
    d_nau.style.display = 'none';
  var d_temas = document.getElementById('d_temas');
    d_temas.style.display = 'none';
  var texto2 = document.getElementById('texto2');

  function valor1(){
    val1 = document.getElementById('val1');
      valor1 = val1.value;

    if(valor1 == ''){
        texto2.style.display = 'block';
    }else{
        texto2.style.display = 'none';
      }

    if(valor1 == 'nau'){
      d_nau.style.display = 'block';
      d_temas.style.display = 'none';
    }else if(valor1 == 'temas'){
        d_temas.style.display = 'block';
        d_nau.style.display = 'none';
      }
  }
</script>
@endsection

  