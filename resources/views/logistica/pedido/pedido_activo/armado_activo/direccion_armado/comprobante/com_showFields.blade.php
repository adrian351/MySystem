<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="created_at">{{ __('Fecha de registro') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
      </div>
       {!! Form::text('created_at', $comprobante->created_at, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Fecha de registro'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="created_at_us">{{ __('Registrado por') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
      </div>
      {!! Form::text('created_at_us', $comprobante->created_at_comp, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Registrado por'), 'readonly' => 'readonly']) !!}
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
       {!! Form::text('updated_at', $comprobante->updated_at, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Fecha última modificación'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="updated_at_us">{{ __('Última modificación por') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
      </div>
      {!! Form::text('updated_at_us', $comprobante->updated_at_comp, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Última modificación por'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="cantidad">{{ __('Cantidad') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('cantidad', Sistema::dosDecimales($comprobante->cant), ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Cantidad'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  @include('venta.pedido.pedido_activo.armado_pedidoActivo.ven_pedAct_armPedAct_showFields.estatus', ['armado' => $comprobante])
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="metodo_de_entrega">{{ __('Método de entrega') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('metodo_de_entrega', $comprobante->met_de_entreg_de_log, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Método de entrega'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="metodo_de_entrega_especifico">{{ __('Método de entrega especifico') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('metodo_de_entrega_especifico', $comprobante->met_de_entreg_de_log_esp, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Método de entrega especifico'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="url_rastreo">{{ __('URL rastreo') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('url_rastreo', $comprobante->url, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('URL rastreo'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="numero_de_guia">{{ __('Número de guia') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('numero_de_guia', $comprobante->num_guia, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Número de guia'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="costo_por_envio">{{ __('Costo por envío') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('costo_por_envio', Sistema::dosDecimales($comprobante->cost_por_env_log), ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Costo por envío'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="nombre_de_la_persona_que_se_lleva_el_pedido">{{ __('Nombre de la persona que se lleva el pedido') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('nombre_de_la_persona_que_se_lleva_el_pedido', $comprobante->nom_de_la_pera_que_se_llev_el_ped, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Nombre de la persona que se lleva el pedido'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="comprobante_de_salida">{{ __('Comprobante de salida') }}</label>
    @if($comprobante->comp_de_sal_nom != null)
      <a href="{{ $comprobante->comp_de_sal_rut.$comprobante->comp_de_sal_nom }}" class="btn btn-info border text-dark" target="_blank"><i class="fas fa-search-plus"></i></a>
      <div class="pad box-pane-right no-padding" style="min-height: 280px">
        <iframe src="{{ $comprobante->comp_de_sal_rut.$comprobante->comp_de_sal_nom }}" style="width:100%;border:none;height:25rem;"></iframe>
      </div>
    @else
      <span class="badge" style="background:{{ config('app.color_c') }};color:{{ config('app.color_0') }};">{{ __('Falta cargar comprobante de salida') }}</span>
    @endif
  </div>
  @if($comprobante->comp_ent_nom != null)
    <div class="form-group col-sm btn-sm">
      <a href="{{ $comprobante->comp_ent_rut.$comprobante->comp_ent_nom }}" class="btn btn-info border text-dark" target="_blank"><i class="fas fa-search-plus"></i></a>
      <label for="comprobante_de_entrega">{{ __('Comprobante de entrega') }}</label>
      <div class="pad box-pane-right no-padding" style="min-height: 280px">
        <iframe src="{{ $comprobante->comp_ent_rut.$comprobante->comp_ent_nom }}" style="width:100%;border:none;height:25rem;"></iframe>
      </div>
    </div>
  @endif
</div>
<div class="row">
  @if($comprobante->comp_cost_por_env_log_nom != null)
    <div class="form-group col-sm btn-sm">
      <a href="{{ $comprobante->comp_cost_por_env_log_rut.$comprobante->comp_cost_por_env_log_nom }}" class="btn btn-info border text-dark" target="_blank"><i class="fas fa-search-plus"></i></a>
      <label for="comprobante_de_entrega">{{ __('Comprobante costo por envío') }}</label>
      <div class="pad box-pane-right no-padding" style="min-height: 280px">
        <iframe src="{{ $comprobante->comp_cost_por_env_log_rut.$comprobante->comp_cost_por_env_log_nom }}" style="width:100%;border:none;height:25rem;"></iframe>
      </div>
    </div>
  @endif
</div>