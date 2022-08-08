<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
  <div class="btn-group mr-4" role="group" aria-label="First group">
    <label for="redes_sociales">{{ __('DATOS DIRECCIÓN DE ENTREGA') }}</label>
  </div>
  <div class="input-group">
    <div class="custom-control custom-switch">
      {!! Form::checkbox('checkbox_direccion', 'on', true, ['id' => 'checkbox_direccion', 'class' => 'custom-control-input' . ($errors->has('checkbox_direccion') ? ' is-invalid' : '')]) !!}
      <label class="custom-control-label" for="checkbox_direccion">{{ __('Guardar dirección escrita') }}</label>
    </div>
  </div>
</div>
<div class="border border-primary rounded p-2">
  @include('rolCliente.direccion.dir_editFields')
</div>