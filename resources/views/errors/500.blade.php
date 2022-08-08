@extends('errors::illustrated-layout')

@section('title', __('Error del Servidor'))
@section('code', '500')
@section('message', __($exception->getMessage() ?: __('Error del Servidor')))
@section('image')
<img src="{{ Sistema::datos()->sistemaFindOrFail()->error_rut . Sistema::datos()->sistemaFindOrFail()->error }}">
@endsection