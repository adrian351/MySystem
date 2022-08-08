@extends('errors::illustrated-layout')

@section('title', __('Extraviado'))
@section('code', '404')
@section('message', __($exception->getMessage() ?: __('Extraviado')))
@section('image')
<img src="{{ Sistema::datos()->sistemaFindOrFail()->error_rut . Sistema::datos()->sistemaFindOrFail()->error }}">
@endsection