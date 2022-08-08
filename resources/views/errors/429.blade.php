@extends('errors::illustrated-layout')

@section('title', __('Demasiadas solicitudes'))
@section('code', '429')
@section('message', __($exception->getMessage() ?: __('Demasiadas solicitudes')))
@section('image')
<img src="{{ Sistema::datos()->sistemaFindOrFail()->error_rut . Sistema::datos()->sistemaFindOrFail()->error }}">
@endsection