@extends('layouts.app')

@section('content_header')
    <div class="p-2">
        <h2>{{ __('messages.create_service') }}</h2>
    </div>
@stop

@section('content')
    @include('admin.services._form', ['service' => $service])
@stop

@section('js')
@endsection
