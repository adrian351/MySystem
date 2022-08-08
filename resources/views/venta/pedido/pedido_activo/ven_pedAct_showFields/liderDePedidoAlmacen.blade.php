<div class="form-group col-sm btn-sm">
  <label for="persona_que_recibe">{{ __('Persona que recibe') }}</label>
  <a href="{{ $pedido->img_firm_rut.$pedido->img_firm }}" class="btn btn-info border text-dark" target="_blank"><i class="fas fa-search-plus"></i></a>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></i></span>
    </div>
    {!! Form::text('persona_que_recibe', $pedido->per_reci_alm, ['class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Persona que recibe'), 'readonly' => 'readonly']) !!}
  </div>
</div>