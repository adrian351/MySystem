<div class="border rounded p-2">
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="usuario">{{ __('Destinatario') }} *</label>
      <div class="custom-control custom-checkbox">
        {{ Form::checkbox('todos_los_usuarios', 'on', null, ['id' => 'todos_los_usuarios', 'class' => 'custom-control-input']) }}
        <label for="todos_los_usuarios" class="custom-control-label">{{ __('Todos los usuarios') }}</label>
      </div>
      <div class="custom-control custom-checkbox">
        {{ Form::checkbox('todos_los_clientes', 'on', null, ['id' => 'todos_los_clientes', 'class' => 'custom-control-input']) }}
        <label for="todos_los_clientes" class="custom-control-label">{{ __('Todos los clientes') }}</label>
      </div>
      <span class="text-danger">{{ $errors->first('todos_los_usuarios') }}</span>
      <span class="text-danger">{{ $errors->first('todos_los_clientes') }}</span>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-envelope"></i></span>
        </div>
        {!! Form::select('usuario[]', $usuarios, null, ['class' => 'form-control select2' . ($errors->has('usuario') ? ' is-invalid' : ''), 'multiple']) !!}
      </div>
      <span class="text-danger">{{ $errors->first('usuario') }}</span>
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="asunto">{{ __('Asunto') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('asunto', null, ['class' => 'form-control' . ($errors->has('asunto') ? ' is-invalid' : ''), 'maxlength' => 20, 'placeholder' => __('Asunto')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('asunto') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="diseno_de_la_notificacion">{{ __('Diseño de la notificación') }} *</label>
    <div class="input-group">
       {!! Form::textarea('diseno_de_la_notificacion', null, ['class' => 'form-control textarea' . ($errors->has('diseno_de_la_notificacion') ? ' is-invalid' : '')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('diseno_de_la_notificacion') }}</span>
  </div>
</div>
<hr>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2"><i class="fas fa-paper-plane text-dark"></i> {{ __('Enviar') }}</button>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_summernote')
@include('layouts.private.plugins.priv_plu_select2')
@section('js2')
<script>
  $('.textarea').summernote({
    tabsize: 4,
    height: 500,
    width: 1500,
    @if(Auth::user()->lang == 'es') lang: "es-ES", @endif
  });
</script>
@endsection