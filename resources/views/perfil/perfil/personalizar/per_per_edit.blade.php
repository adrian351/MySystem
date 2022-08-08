@extends('perfil.perfil.per_per_index')
@section('contenidoPerfil')
{!! Form::open(['route' => 'perfil.personalizar.update', 'method' => 'patch', 'id' => 'perfilPersonalizarUpdate']) !!}
    @include('perfil.perfil.personalizar.per_per_editFields')
{!! Form::close() !!}
@endsection