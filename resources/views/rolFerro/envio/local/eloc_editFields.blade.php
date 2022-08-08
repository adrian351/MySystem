<div class="row">
	<div class="form-group col-sm btn-sm">
		<label for="ruta">{{ __('Ruta') }} *</label>
		<div class="input-group">
			<div class="input-group-prepend">
				<span class="input-group-text"><i class="fas fa-list"></i></span>
			</div>
			{!! Form::select('ruta', $rutas, $envio->rut, ['class' => 'form-control select2' . ($errors->has('ruta') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
		</div>
		<span class="text-danger">{{ $errors->first('ruta') }}</span>
	</div>
</div>
@include('layouts.private.plugins.priv_plu_select2')