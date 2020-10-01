@extends('layouts.app')

@section('title', @trans('messages.edit_customer'))

@section('content_header')

<div class="d-flex justify-content-between w-100 flex-wrap">
    <div class="mb-3 mb-lg-0">
        <h2>{{ __('messages.edit_customer') }}</h2>
    </div>
    <div>
        <a href="{{ route('admin.customers.index') }}" class="btn btn-gray">{{ @trans('messages.go_back') }}</a>
    </div>
</div>

@stop

@section('content')
<div class="p-3">
    @include('admin.customers._form', ['customer' => $customer])
</div>
@stop

@section('js')
@endsection
