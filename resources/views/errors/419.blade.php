@extends('errors::illustrated-layout')

@section('title', __('Página caducada'))
@section('code', '419')
@section('message', __($exception->getMessage() ?: __('Página caducada')))
@section('image')
<img src="{{ Sistema::datos()->sistemaFindOrFail()->error_rut . Sistema::datos()->sistemaFindOrFail()->error }}">
@endsection