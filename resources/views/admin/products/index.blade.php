@extends('layouts.app')

@section('title', __('messages.products'))

@section('content_header')

    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h2>{{ __('messages.products') }}</h2>
        </div>
    </div>

@stop

@section('content')

    @livewire('products.index')

@stop
