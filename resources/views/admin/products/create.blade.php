@extends('adminlte::page')

@section('title', @trans('messages.create_product'))

@section('content_header')
    <div class="p-2">
        <h2>{{ @trans('messages.create_product') }}</h2>
    </div>
@stop

@section('content')
    <div class="card card-primary">
        @include('admin.products._form', ['product' => $product])
    </div>
@stop

@section('js')
@endsection
