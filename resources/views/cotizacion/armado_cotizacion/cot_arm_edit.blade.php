@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar armado').' '.$armado->nom)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Editar armado') }}: </strong>
      @can('cotizacion.armado.show')
        <a href="{{ route('cotizacion.armado.show', Crypt::encrypt($armado->id)) }}" class="text-white">{{ $armado->nom }}</a>
      @else
        {{ $armado->nom }}
      @endcan
      <strong>{{ __('de la cotización') }}: </strong>{{ $armado->cotizacion->serie }}
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}"> 
      <small>{{ $armado->id }}</small>
    </div>
  </div>
  <div class="card-body">
    @include('armado.arm_showFields.medidas')
    {!! Form::open(['route' => ['cotizacion.armado.update', Crypt::encrypt($armado->id)], 'method' => 'patch', 'id' => 'cotizacionArmadoUpdate']) !!}
      @if (count($errors) > 0)
        @foreach ($errors->all() as $message)
          <div class="alert alert-danger p-1" role="alert">
            <strong>Error: </strong>{{ $message }}
          </div>
        @endforeach
      @endif
      @include('cotizacion.armado_cotizacion.cot_arm_editFields')
    {!! Form::close() !!}
  </div>
</div>
@if($armado->es_de_stock == 'No' || $armado->es_de_stock == '')
  @include('cotizacion.armado_cotizacion.producto_armado.cot_arm_pro_index')
@endif

@include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_index')
@include('layouts.private.plugins.priv_plu_select2')
@endsection