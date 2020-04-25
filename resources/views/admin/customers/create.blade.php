@extends('adminlte::page')

@section('title', @trans('messages.create_customer'))

@section('content_header')
    <div class="p-2">
        <h2>{{ @trans('messages.create_customer') }}</h2>
    </div>
@stop

@section('content')
    <div class="card card-primary">
        @include('admin.customers._form', ['customer' => $customer])
    </div>
@stop

@section('js')
@endsection
