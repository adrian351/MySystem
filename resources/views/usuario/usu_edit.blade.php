@extends('layouts.private.escritorio.dashboard')
@section('recapcha')
{!! htmlScriptTagJsApi([
  'action' => 'homepage',
  'callback_then' => 'callbackThen',
  'callback_catch' => 'callbackCatch'
]) !!}
@endsection
@section('contenido')
<title>@section('title', __('Editar usuario').' '.$usuario->nom)</title>
@include('usuario.show.usu_sho_menu')
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Editar registro') }}: </strong>
      @can('usuario.show')
        <a href="{{ route('usuario.show', Crypt::encrypt($usuario->id)) }}" class="text-white">{{ $usuario->nom }}</a>
      @else
        {{ $usuario->nom }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}"> 
      <small>{{ $usuario->id }}</small>
    </div>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => ['usuario.update', Crypt::encrypt($usuario->id)], 'method' => 'patch', 'id' => 'usuarioUpdate', 'files' => true]) !!}
      @include('usuario.usu_editFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection