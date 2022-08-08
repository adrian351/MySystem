<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="created_at">{{ __('Fecha de registro') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
      </div>
       {!! Form::text('created_at', $manual->created_at, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Fecha de registro'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="created_at_reg">{{ __('Registrado por') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
      </div>
      {!! Form::text('created_at_reg', $manual->created_at_reg, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Registrado por'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="updated_at">{{ __('Fecha última modificación') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
      </div>
       {!! Form::text('updated_at', $manual->updated_at, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Fecha última modificación'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="updated_at_reg">{{ __('Última modificación por') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
      </div>
      {!! Form::text('updated_at_reg', $manual->updated_at_reg, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Última modificación por'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="usuario_que_puede_visualizarlo">{{ __('Usuario que puede visualizarlo') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('usuario_que_puede_visualizarlo', config('opcionesSelect.select_usu_cli_ambos'), $manual->usu_cli_ambos, ['class' => 'form-control select2 disabled', 'placeholder' => __(''), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="valor">{{ __('Valor') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('valor', $manual->valor, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Valor'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  @if($manual->nom_edit != null)
    <a href="{{ $manual->rut_edit.$manual->nom_edit }}" class="btn btn-primary" download>{{ __('Descargar editable') }}</a>
  @endif
</div>
<div class="row">
  @if($manual->nom != null)
    <div class="form-group col-sm btn-sm">
      <a href="{{ $manual->rut.$manual->nom }}" class="btn btn-info border text-dark" target="_blank"><i class="fas fa-search-plus"></i></a>
      <div class="pad box-pane-right no-padding" style="min-height: 280px">
        <iframe src="{{ $manual->rut.$manual->nom }}" style="width:100%;border:none;height:25rem;"></iframe>
      </div>
    </div>
  @endif
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <center><a href="{{ route('manual.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a></center>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')
@section('js2')
<script>
  $('.select2').prop("disabled", true);
</script>
@endsection