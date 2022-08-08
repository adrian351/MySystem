<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="nombre_de_la_persona_que_recibe_uno">{{ __('Nombre de la persona que recibe uno') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
        {!! Form::text('nombre_de_la_persona_que_recibe_uno', $direccion->nom_ref_uno, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Nombre de la persona que recibe uno'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="nombre_de_la_persona_que_recibe_dos">{{ __('Nombre de la persona que recibe dos') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('nombre_de_la_persona_que_recibe_dos', $direccion->nom_ref_dos, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Nombre de la persona que recibe dos'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="telefono_fijo">{{ __('Teléfono fijo') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-tty"></i></span>
      </div>
      {!! Form::number('lada_telefono_fijo', $direccion->lad_fij, ['class' => 'form-control disabled', 'min' => 1, 'max' => 0, 'placeholder' => __('Lada teléfono fijo'), 'readonly' => 'readonly']) !!}
      {!! Form::text('telefono_fijo', $direccion->tel_fij, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Teléfono fijo'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="extension">{{ __('Extensión') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-phone"></i></span>
      </div>
        {!! Form::text('extension', $direccion->ext	, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Extensión'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="telefono_movil">{{ __('Teléfono móvil') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
      </div>
        {!! Form::number('lada_telefono_movil', $direccion->lad_mov, ['class' => 'form-control disabled', 'min' => 1, 'max' => 0, 'placeholder' => __('Lada teléfono móvil'), 'readonly' => 'readonly']) !!}
        {!! Form::text('telefono_movil', $direccion->tel_mov, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Teléfono móvil'), 'readonly' => 'readonly']) !!}
    </div>
  </div>

  <div class="form-group col-sm btn-sm">
    <label for="pais">{{ __('País') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
        {!! Form::text('pais', $direccion->pais, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('País'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="calle">{{ __('Calle') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-road"></i></span>
      </div>
        {!! Form::text('calle', $direccion->calle, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Calle'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="no_exterior">{{ __('No. Exterior') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('no_exterior', $direccion->no_ext, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('No. Exterior'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="no_interior">{{ __('No. Interior') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('no_interior', $direccion->no_int, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('No. Interior'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="ciudad">{{ __('Ciudad') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
      </div>
      {!! Form::text('ciudad', $direccion->ciudad, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Ciudad'), 'readonly' => 'readonly']) !!}
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
        {!! Form::text('colonia', $direccion->col, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Colonia'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="delegacion_o_municipio">{{ __('Delegación o municipio') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-city"></i></span>
      </div>
      {!! Form::text('delegacion_o_municipio', $direccion->del_o_munic, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Delegación o municipio'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="codigo_postal">{{ __('Código postal') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-mail-bulk"></i></span>
      </div>
        {!! Form::text('codigo_postal', $direccion->cod_post, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Código postal'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="referencias_zona_de_entrega">{{ __('Referencias zona de entrega') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('referencias_zona_de_entrega', $direccion->ref_zon_de_entreg, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Referencias zona de entrega'), 'rows' => 4, 'cols' => 4, 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')