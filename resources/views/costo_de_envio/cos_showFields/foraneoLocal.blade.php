<div class="form-group col-sm btn-sm">
  <label for="foraneo_o_local">{{ __('Foráneo o local') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-list"></i></span>
    </div>
    {!! Form::text('foraneo_o_local', $costo_de_envio->for_loc, ['class' => 'form-control', 'placeholder' => __('Foráneo o local'), 'readonly' => 'readonly']) !!}
  </div>
</div>