@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Registrar armado'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('armado.arm_menu')
    </ul>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => 'armado.store', 'onsubmit' => 'return checarBotonSubmit("btnsubmit")', 'files' => true]) !!}
      @include('armado.arm_createFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection