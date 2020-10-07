@extends('layouts.app')

@section('title', __('messages.edit_product'))
@section('content_header')
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h2>{{ __('messages.edit_product') }}</h2>
        </div>
    </div>
@stop

@section('content')
    @include('admin.products._form', ['product' => $product])
@stop

