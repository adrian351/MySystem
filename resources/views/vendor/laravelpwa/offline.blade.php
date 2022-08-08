@extends('layouts.public.dashboard')
@section('header')
  <title>@section('title', __('Modo offline'))</title>
@endsection
@section('contenido')
<div class="container">
  @include('layouts.public.logo')
  <div class="shadow-lg p-3">
    <h1>{{ __('Actualmente no estás conectado a ninguna red') }}.</h1>
  </div>
</div>
@endsection