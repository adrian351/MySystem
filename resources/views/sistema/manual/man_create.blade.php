@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Subir manual'))</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <h5 class="box-title">{{ __('Subir manual') }}</h5>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => 'manual.store', 'onsubmit' => 'return checarBotonSubmit("btnsubmit")', 'files' => true]) !!}
      @include('sistema.manual.man_createFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection