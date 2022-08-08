<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="costo_por_envio">{{ __('Costo por envío') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
        {!! Form::text('costo_por_envio', null, ['v-model' => 'costo_por_envio', 'v-on:change' => 'getDecimales()', 'id' => 'costo_por_envio', 'class' => 'form-control', 'maxlength' => 15, 'placeholder' => __('Costo por envío')]) !!}
    </div>
    <span v-if="errors.costo_por_envio" class="text-danger" v-text="errors.costo_por_envio[0]"></span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="metodo_de_entrega">{{ __('Método de entrega') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::select('metodo_de_entrega', $metodos_de_entrega, $direccion->met_de_entreg, ['v-model' => 'metodo_de_entrega', 'v-on:change' => 'getMetodosDeEntregaEspecificos()', 'class' => 'form-control select2', 'placeholder' => __(''), 'required']) !!}
    </div>
    <span v-if="errors.metodo_de_entrega" class="text-danger" v-text="errors.metodo_de_entrega[0]"></span>
  </div>
  <div class="form-group col-sm btn-sm" id="metodo_de_entrega_especifico" style="display:none">
    <label for="metodo_de_entrega_especifico">{{ __('Método de entrega especifico') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      <select v-model='metodo_de_entrega_especifico' class ='form-control' data-old='{{ old('metodo_de_entrega_especifico')}}' name='metodo_de_entrega_especifico'>
        <option value="">Seleccione. . .</option>
        <option v-for="metodo_de_entrega_esp in metodos_de_entrega_especificos" v-bind:value="metodo_de_entrega_esp" v-text="metodo_de_entrega_esp"></option>
      </select>
    </div>
    <span v-if="errors.metodo_de_entrega_especifico" class="text-danger" v-text="errors.metodo_de_entrega_especifico[0]"></span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="comprobante_de_salida">{{ __('Comprobante de salida') }}</label>
    @if($direccion->comp_de_sal_nom != NULL)
      @php
        $nombre = pathinfo($direccion->comp_de_sal_nom, PATHINFO_EXTENSION);
      @endphp
      @if ($nombre == 'xlsx')
        <div class="card" style="background: rgb(213, 247, 213)">
          <div class="card-body p-2">
            <i class="fas fa-download"></i>&nbsp;&nbsp;&nbsp;
            Excel: 
            <a href="{{ $direccion->comp_de_sal_rut.$direccion->comp_de_sal_nom }}" download >{{ $direccion->comp_de_sal_nom }}</a>
          </div>
        </div>
      @else
        <a href="{{ $direccion->comp_de_sal_rut.$direccion->comp_de_sal_nom }}" class="btn btn-info border text-dark" target="_blank"><i class="fas fa-search-plus"></i></a>
        <div class="pad box-pane-right no-padding" style="min-height: 280px">
          <iframe src="{{ $direccion->comp_de_sal_rut.$direccion->comp_de_sal_nom }}" style="width:100%;border:none;height:15rem;"></iframe>
        </div>
      @endif
    @endif
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <div class="custom-file"> 
      {{--  {!! Form::file('imagen', ['v-on:change' => 'getImage', 'id' => 'file', 'class' => 'custom-file-input', 'accept' => 'image/jpeg,image/png,image/jpg,image/ico', 'lang' => Auth::user()->lang]) !!}  --}}
      {!! Form::file('imagen', ['v-on:change' => 'getImage', 'id' => 'file', 'class' => 'custom-file-input', 'accept' => 'image/jpeg,image/png,image/jpg,image/ico/pdf/xlsx', 'lang' => Auth::user()->lang]) !!}
      <label class="custom-file-label" for="archivo">Max. 10MB</label>
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <input type=button value="{{ __('Capturar foto') }}" v-on:click="capturarFoto()" class="btn btn-info w-100 p-2">
  </div>
  <div class="form-group col-sm btn-sm">
    <input type=button value="{{ __('Quitar foto') }}" v-on:click="quitarFoto()" class="btn btn-info w-100 p-2">
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
      {!! Form::hidden('mydata', null, ['id' => 'mydata', 'class' => 'form-control']) !!}
      <div id="my_camera"></div>
      <div id="results"></div>
    <span v-if="errors.comprobante_de_salida" class="text-danger" v-text="errors.comprobante_de_salida[0]"></span>
  </div>
</div>