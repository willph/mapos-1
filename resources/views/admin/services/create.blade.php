@extends('adminlte::page')

@section('title', @trans('messages.create_service'))

@section('content_header')
    <div class="p-2">
        <h2>{{ @trans('messages.create_service') }}</h2>
    </div>
@stop

@section('content')
    <div class="card card-primary">
        @include('admin.services._form', ['service' => $service])
    </div>
@stop

@section('js')
@endsection
