@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Registrar serie'))</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <h5 class="box-title">{{ __('Registrar serie') }}</h5>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => 'sistema.serie.store', 'onsubmit' => 'return checarBotonSubmit("btnsubmit")']) !!}
      @include('sistema.serie.sis_ser_createFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection