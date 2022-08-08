@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Registrar contacto o sucursal'))</title>
<div class="card {{ config('app.color_card_primario') }} card-outline">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Registrar contacto o sucursal al proveedor') }}:</strong> {{ $proveedor->nom_comerc }}
    </h5>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => ['proveedor.contacto.store', Crypt::encrypt($proveedor->id)], 'onsubmit' => 'return checarBotonSubmit("btnsubmit")']) !!}
      @include('proveedor.contacto_proveedor.pro_conPro_createFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection