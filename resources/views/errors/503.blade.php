@extends('errors::illustrated-layout')

@section('title', __('Servicio no disponible'))
@section('code', '503')
@section('message', __($exception->getMessage() ?: __('Servicio no disponible')))
@section('image')
<img src="{{ Sistema::datos()->sistemaFindOrFail()->error_rut . Sistema::datos()->sistemaFindOrFail()->error }}">
@endsection