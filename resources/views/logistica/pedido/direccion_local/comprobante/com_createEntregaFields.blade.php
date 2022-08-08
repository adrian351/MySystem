<div class="row">
  <div class="form-group col-sm btn-sm" id="metodo_de_entrega_especifico" style="display:none">
    <label for="metodo_de_entrega_especifico">{{ __('Método de entrega especifico') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      <select v-model='metodo_de_entrega_especifico' v-on:change='displatNumeroDeGuia()' class ='form-control' data-old='{{ old('metodo_de_entrega_especifico')}}' name='metodo_de_entrega_especifico'>
        <option value="">Seleccione. . .</option>
        <option v-for="metodo_de_entrega_esp in metodos_de_entrega_especificos" v-bind:value="metodo_de_entrega_esp" v-text="metodo_de_entrega_esp"></option>
      </select>
    </div>
    <span v-if="errors.metodo_de_entrega_especifico" class="text-danger" v-text="errors.metodo_de_entrega_especifico[0]"></span>
  </div>
  <div class="form-group col-sm btn-sm" id="paqueteria" style="display:none">
    <label for="paqueteria">{{ __('Paquetería') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      <select v-model='paqueteria' class ='form-control' data-old='{{ old('paqueteria')}}' name='paqueteria'>
        <option value="">Seleccione. . .</option>
        <option v-for="metodo_de_entrega_esp in paqueterias" v-bind:value="metodo_de_entrega_esp" v-text="metodo_de_entrega_esp"></option>
      </select>
    </div>
    <span v-if="errors.paqueteria" class="text-danger" v-text="errors.paqueteria[0]"></span>
  </div>
  <div class="form-group col-sm btn-sm" id="numero_de_guia"  style="display:none">
    <label for="numero_de_guia">{{ __('Número de guia') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
        {!! Form::text('numero_de_guia', null, ['v-model' => 'numero_de_guia', 'class' => 'form-control', 'maxlength' => 60, 'placeholder' => __('Número de guia')]) !!}
    </div>
    <span v-if="errors.numero_de_guia" class="text-danger" v-text="errors.numero_de_guia[0]"></span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="comprobante_de_entrega">{{ __('Comprobante de entrega') }}</label>
    @if(!$direccion->comprobantes->isEmpty())
      @if($direccion->comprobantes[0]->comp_ent_nom != NULL)
        <a href="{{ $direccion->comprobantes[0]->comp_ent_rut.$direccion->comprobantes[0]->comp_ent_nom }}" class="btn btn-info border text-dark" target="_blank"><i class="fas fa-search-plus"></i></a>
      @endif
    @endif
  </div>
</div>
@if(!$direccion->comprobantes->isEmpty())
  <div class="row">
    <div class="form-group col-sm btn-sm">
      @if($direccion->comprobantes[0]->comp_ent_nom != NULL)
        <div class="pad box-pane-right no-padding" style="min-height: 280px">
          <iframe src="{{ $direccion->comprobantes[0]->comp_ent_rut.$direccion->comprobantes[0]->comp_ent_nom }}" style="width:100%;border:none;height:15rem;"></iframe>
        </div>
      @endif
    </div>
  </div>
@endif
<div class="row">
  <div class="form-group col-sm btn-sm">
    <div class="custom-file">
      {{-- {!! Form::file('imagen', ['v-on:change' => 'getImage', 'id' => 'file', 'class' => 'custom-file-input', 'accept' => 'image/jpeg,image/png,image/jpg,image/ico/pdf', 'lang' => Auth::user()->lang]) !!} --}}
      {!! Form::file('imagen', ['v-on:change' => 'getImage', 'id' => 'file', 'class' => 'custom-file-input', 'accept' => 'image/jpeg,image/png,image/jpg,image/ico/pdf', 'lang' => Auth::user()->lang]) !!}
      <label class="custom-file-label" for="archivo">Max 10MB</label>
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
    <span v-if="errors.comprobante_de_entrega" class="text-danger" v-text="errors.comprobante_de_entrega[0]"></span>
  </div>
</div>