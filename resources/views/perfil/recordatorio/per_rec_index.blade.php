@extends('layouts.private.perfil.dashboard')
@section('titulo')
<div class="col-sm-6">
  <h1 class="m-0 text-dark"> {{ __('En construcción...') }}</h1>
</div>
@endsection
@section('contenido')
<title>@section('title', 'Recordatorios')</title>
@include('enConstruccion')
@endsection