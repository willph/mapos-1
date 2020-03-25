@extends('adminlte::page')

@section('title', @trans('messages.create_user'))

@section('content_header')
    <div class="p-2">
        <h2>{{ @trans('messages.create_user') }}</h2>
    </div>
@stop

@section('content')
    <div class="card card-primary">
        @include('admin.users._form', ['user' => $user])
    </div>
@stop

@section('js')
@endsection
