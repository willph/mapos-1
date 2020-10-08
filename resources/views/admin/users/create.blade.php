@extends('layouts.app')

@section('title', __('messages.create_user'))

@section('content_header')
    <div class="p-2">
        <h2>{{ __('messages.create_user') }}</h2>
    </div>
@stop

@section('content')
    <div class="card card-primary">
        @include('admin.users._form', ['user' => $user])
    </div>
@stop

@section('js')
@endsection
