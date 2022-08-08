@extends('errors::illustrated-layout')

@section('title', __('No autorizado'))
@section('code', '401')
@section('message', __($exception->getMessage() ?: __('No autorizado')))
@section('image')
<img src="{{ Sistema::datos()->sistemaFindOrFail()->error_rut . Sistema::datos()->sistemaFindOrFail()->error }}">
@endsection