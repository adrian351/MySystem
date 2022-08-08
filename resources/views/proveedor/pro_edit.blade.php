@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar proveedor').' '.$proveedor->nom_comerc)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    @include('proveedor.pro_archivo')
    <h5>
      <strong>{{ __('Editar registro') }}:</strong>
      @can('proveedor.show')
        <a href="{{ route('proveedor.show', Crypt::encrypt($proveedor->id)) }}" class="text-white">{{ $proveedor->nom_comerc }}</a>
      @else
        {{ $proveedor->nom_comerc }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}">
      <small>{{ $proveedor->id }}</small>
    </div>
  </div>
</div>
@can('proveedor.editValidado')
  <div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
    <div class="card-body">
      {!! Form::open(['route' => ['proveedor.updateValidado', Crypt::encrypt($proveedor->id)], 'method' => 'patch', 'id' => 'proveedorUpdateValidado']) !!}
        @include('proveedor.pro_editValidadoFields')
      {!! Form::close() !!}
    </div>
  </div>
@endcan
@can('proveedor.edit')
  <div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
    <div class="card-body">
      {!! Form::open(['route' => ['proveedor.update', Crypt::encrypt($proveedor->id)], 'method' => 'patch', 'id' => 'proveedorUpdate', 'files' => true]) !!}
        @include('proveedor.pro_editFields')
      {!! Form::close() !!}
    </div>
  </div>
@endcan
@include('layouts.private.plugins.priv_plu_select2')
@include('proveedor.contacto_proveedor.pro_conPro_index')
@include('proveedor.productos.pro_index')
@endsection