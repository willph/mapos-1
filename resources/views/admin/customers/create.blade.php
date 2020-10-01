@extends('layouts.app')

@section('title', @trans('messages.create_customer'))

@section('content_header')
<div class="d-flex justify-content-between w-100 flex-wrap">
    <div class="mb-3 mb-lg-0">
        <h2>{{ @trans('messages.create_customer') }}</h2>
    </div>
    <div><a class="btn btn-primary" href="{{ route('admin.customers.index') }}">{{ __('messages.go_back') }}</a></div>
</div>

@stop

@section('content')
@include('admin.customers._form', ['customer' => $customer])
@stop

@section('js')
@endsection
