<div class="form-group col-sm btn-sm">
  <label for="cliente">
    @can('cliente.show')
      <a href="{{ route('cliente.show', Crypt::encrypt($pedido->usuario->id)) }}" target="_blank"> {{ __('Cliente') }}</a>
    @else
    {{ __('Cliente') }}
    @endcan
  </label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
    {!! Form::text('cliente', $pedido->usuario->nom.' ('.$pedido->usuario->email_registro.')', ['class' => 'form-control disable', 'maxlength' => 0, 'placeholder' => __('Cliente'), 'readonly' => 'readonly']) !!}
  </div>
</div>