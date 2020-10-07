@extends('layouts.app')

@section('title', @trans('messages.view_customer'))

@section('content_header')

<div class="d-flex justify-content-between w-100 flex-wrap">
    <div class="mb-3 mb-lg-0">
        <h2>{{ __('messages.view_customer') }}</h2>
    </div>

</div>

@stop

@section('content')
<div class="p-3">
    <table class="table table-bordered table-striped">
        <tbody>
            <tr>
                <td class="w-50">{{ @trans('messages.name') }}</td>
                <td class="w-50">{{ $customer->name }}</td>
            </tr>
            <tr>
                <td class="w-50">{{ @trans('messages.document_number') }}</td>
                <td class="w-50">{{ $customer->document_number }}</td>
            </tr>
            <tr>
                <td class="w-50">{{ @trans('messages.phone_number') }}</td>
                <td class="w-50">{{ $customer->phone_number }}</td>
            </tr>
            <tr>
                <td class="w-50">{{ @trans('messages.mobile_phone_number') }}</td>
                <td class="w-50">{{ $customer->mobile_phone_number }}</td>
            </tr>
            <tr>
                <td class="w-50">{{ @trans('messages.email') }}</td>
                <td class="w-50">{{ $customer->email }}</td>
            </tr>
            <tr>
                <td class="w-50">{{ @trans('messages.postal_code') }}</td>
                <td class="w-50">{{ $customer->postal_code }}</td>
            </tr>
            <tr>
                <td class="w-50">{{ @trans('messages.street_number') }}</td>
                <td class="w-50">{{ $customer->street_number }}</td>
            </tr>
            <tr>
                <td class="w-50">{{ @trans('messages.street_name') }}</td>
                <td class="w-50">{{ $customer->street_name }}</td>
            </tr>
            <tr>
                <td class="w-50">{{ @trans('messages.neighborhood') }}</td>
                <td class="w-50">{{ $customer->neighborhood }}</td>
            </tr>
            <tr>
                <td class="w-50">{{ @trans('messages.city') }}</td>
                <td class="w-50">{{ $customer->city }}</td>
            </tr>
            <tr>
                <td class="w-50">{{ @trans('messages.state') }}</td>
                <td class="w-50">{{ $customer->state }}</td>
            </tr>
            <tr>
                <td class="w-50">{{ @trans('messages.complement') }}</td>
                <td class="w-50">{{ $customer->complement }}</td>
            </tr>
            <tr>
                <td class="w-50">{{ @trans('messages.contact') }}</td>
                <td class="w-50">{{ $customer->contact }}</td>
            </tr>
            <tr>
                <td class="w-50">{{ @trans('messages.created_at') }}</td>
                <td class="w-50">@datetime($customer->created_at)</td>
            </tr>
            <tr>
                <td class="w-50">{{ @trans('messages.updated_at') }}</td>
                <td class="w-50">@datetime($customer->updated_at)</td>
            </tr>
        </tbody>
    </table>

    <div class="mt-3">
        <a href="{{ route('admin.customers.index') }}" class="btn btn-light"> <i class="fa fa-arrow-left"></i> {{ @trans('messages.go_back') }}</a>
    </div>

</div>
@stop

@section('js')
@endsection
