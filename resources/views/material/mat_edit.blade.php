@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar material').' '.$material->sku)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Editar registro') }}: </strong>
      @can('material.show')
        <a href="{{ route('material.show', Crypt::encrypt($material->id)) }}" class="text-white">{{ $material->sku }}</a>
      @else
        {{ $material->sku }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}"> 
      <small>{{ $material->sku }}</small>
    </div>
  </div>
  <div class="card-body">
    {!! Form::open(['route' => ['material.update', Crypt::encrypt($material->id)], 'method' => 'patch', 'id' => 'materialUpdate']) !!}
      @include('material.mat_editFields')
    {!! Form::close() !!}
  </div>
</div>
@endsection