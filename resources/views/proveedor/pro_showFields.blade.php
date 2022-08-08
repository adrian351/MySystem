<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="created_at">{{ __('Fecha de registro') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
      </div>
       {!! Form::text('created_at', $proveedor->created_at, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Fecha de registro'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="created_at_prov">{{ __('Registrado por') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
      </div>
      {!! Form::text('created_at_prov', $proveedor->created_at_prov, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Registrado por'), 'readonly' => 'readonly']) !!}
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
       {!! Form::text('updated_at', $proveedor->updated_at, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Fecha última modificación'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="updated_at_prov">{{ __('Última modificación por') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
      </div>
      {!! Form::text('updated_at_prov', $proveedor->updated_at_prov, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Última modificación por'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="proveedor_validado">{{ __('¿Proveedor validado?') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-question"></i></span>
      </div>
      {!! Form::text('proveedor_validado', $proveedor->prov_valid, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('¿Proveedor validado?'), 'readonly' => 'readonly']) !!}
    </div>
    <span class="text-danger">{{ $errors->first('proveedor_validado') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="razon_social">{{ __('Razón social') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
        {!! Form::text('razon_social', $proveedor->raz_soc, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Razón social'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="nombre_comercial">{{ __('Nombre comercial') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('nombre_comercial', $proveedor->nom_comerc , ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Nombre comercial'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="fabricante_distribuidor">{{ __('Fabricante / Distribuidor') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('fabricante_distribuidor', config('opcionesSelect.select_fabricante_distribuidor_index'), $proveedor->fab_distri, ['class' => 'form-control select2 disabled', 'placeholder' => __(''), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="rfc">{{ __('RFC') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('rfc', $proveedor->rfc, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('RFC'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="nombre_del_representante_legal">{{ __('Nombre del representante legal') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('nombre_del_representante_legal', $proveedor->nom_rep_legal, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Nombre del representante legal'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="pagina_web">{{ __('Página web') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-globe"></i></span>
      </div>
      {!! Form::text('pagina_web', $proveedor->pag_web, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Página web'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="telefono_fijo">{{ __('Teléfono fijo') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-tty"></i></span>
      </div>
      {!! Form::number('lada_telefono_fijo', $proveedor->lad_fij, ['class' => 'form-control disabled', 'min' => 0, 'max' => 0, 'placeholder' => __('Lada teléfono fijo'), 'readonly' => 'readonly']) !!}
      {!! Form::text('telefono_fijo', $proveedor->tel_fij, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Teléfono fijo'), 'readonly' => 'readonly' ] ) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="extension">{{ __('Extensión') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-phone"></i></span>
      </div>
        {!! Form::text('extension', $proveedor->ext, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Extensión'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="telefono_movil">{{ __('Teléfono móvil') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
      </div>
        {!! Form::number('lada_telefono_movil', $proveedor->lad_mov, ['class' => 'form-control disabled', 'min' => 0, 'max' => 0, 'placeholder' => __('Lada teléfono móvil'), 'readonly' => 'readonly']) !!}
        {!! Form::text('telefono_movil', $proveedor->tel_mov, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Teléfono móvil'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="cantidad_o_monto_minimo_de_compra">{{ __('Cantidad o monto mínimo de compra') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::select('opcion', config('opcionesSelect.select_opcion_prov'), $proveedor->ops, ['class' => 'form-control disabled', 'placeholder' => __('Seleccione. . .'), 'disabled' => 'disabled']) !!}
      {!! Form::text('cantidad_o_monto_minimo_de_compra', $proveedor->cant_min_comp, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Cantidad o monto mínimo de compra'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="observaciones">{{ __('Observaciones') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('observaciones', $proveedor->obs, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Observaciones'), 'rows' => 4, 'cols' => 4, 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<label for="redes_sociales">{{ __('DIRECCION') }}</label>
<div class="border border-primary rounded p-2">
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="calle">{{ __('Calle') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-road"></i></span>
        </div>
        {!! Form::text('calle', $proveedor->call, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Calle'), 'readonly' => 'readonly']) !!}
      </div>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="no_ext">{{ __('No. Ext.') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::text('no_ext', $proveedor->no_ext, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('No. Ext.'), 'readonly' => 'readonly']) !!}
      </div>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="no_int">{{ __('No. Int.') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::text('no_int', $proveedor->no_int, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('No. Int.'), 'readonly' => 'readonly']) !!}
      </div>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="pais">{{ __('Pais') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::text('pais', $proveedor->pais, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Pais'), 'readonly' => 'readonly']) !!}
      </div>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="ciudad">{{ __('Ciudad') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
        </div>
        {!! Form::text('ciudad', $proveedor->ciudad, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Ciudad'), 'readonly' => 'readonly']) !!}
      </div>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="colonia">{{ __('Colonia') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::text('colonia', $proveedor->col, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Colonia'), 'readonly' => 'readonly']) !!}
      </div>
    </div>
    <div class="form-group col-sm btn-sm">
      <label for="delegacion_o_municipio">{{ __('Delegación o municipio') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-city"></i></span>
        </div>
        {!! Form::text('delegacion_o_municipio', $proveedor->del_o_munic, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Delegación o municipio'), 'readonly' => 'readonly']) !!}
      </div>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="codigo_postal">{{ __('Código postal') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::text('codigo_postal', $proveedor->cod_post, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Código postal'), 'readonly' => 'readonly']) !!}
      </div>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm btn-sm">
      <label for="referencias">{{ __('Referencias') }}</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
        {!! Form::textarea('referencias', $proveedor->ref, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Referencias'), 'rows' => 4, 'cols' => 4, 'readonly' => 'readonly']) !!}
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <center><a href="{{ route('proveedor.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-undo text-dark"></i> {{ __('Regresar') }}</a></center>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')
@section('js2')
<script>
$('.select2').prop("disabled", true);
</script>
@endsection