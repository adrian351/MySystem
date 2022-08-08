@if($pago->not != null)
<div class="form-group col-sm btn-sm">
    <label for="nota_importante">{{ __('Nota importante') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text border-danger"><i class="fas fa-text-width"></i></span>
      </div>
        {!! Form::text('nota_importante', $pago->not, ['class' => 'form-control disabled border-danger', 'maxlength' => 0, 'placeholder' => __('Nota importante'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
@endif