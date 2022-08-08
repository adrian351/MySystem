@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Registrar rol'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('rol.rol_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => 'rol.store', 'onsubmit' => 'return checarBotonSubmit("btnsubmit")']) !!}
      @include('rol.rol.rol_rol_createFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection