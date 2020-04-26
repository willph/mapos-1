@extends('adminlte::page')

@section('title', @trans('messages.view_product'))

@section('content_header')
    <div class="p-2">
        <h2>{{ @trans('messages.view_product') }}</h2>
    </div>
@stop

@section('content')
    <div class="card card-primary p-4">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <td class="w-50">{{ @trans('messages.name') }}</td>
                    <td class="w-50">{{ $product->name }}</td>
                </tr>
                <tr>
                    <td class="w-50">{{ @trans('messages.description') }}</td>
                    <td class="w-50">{{ $product->description }}</td>
                </tr>
                <tr>
                    <td class="w-50">{{ @trans('messages.barcode') }}</td>
                    <td class="w-50">{{ $product->barcode }}</td>
                </tr>
                <tr>
                    <td class="w-50">{{ @trans('messages.purchase_price') }}</td>
                    <td class="w-50">{{ $product->purchase_price }}</td>
                </tr>
                <tr>
                    <td class="w-50">{{ @trans('messages.sale_price') }}</td>
                    <td class="w-50">{{ $product->sale_price }}</td>
                </tr>
                <tr>
                    <td class="w-50">{{ @trans('messages.unit') }}</td>
                    <td class="w-50">{{ $product->unit }}</td>
                </tr>
                <tr>
                    <td class="w-50">{{ @trans('messages.quantity_in_stock') }}</td>
                    <td class="w-50">{{ $product->quantity_in_stock }}</td>
                </tr>
                <tr>
                    <td class="w-50">{{ @trans('messages.minimum_quantity_in_stock') }}</td>
                    <td class="w-50">{{ $product->minimum_quantity_in_stock }}</td>
                </tr>
            </tbody>
        </table>

        <div class="mt-3">
            <a href="{{ route('admin.products.index') }}" class="btn btn-primary">{{ @trans('messages.go_back') }}</a>
        </div>
    </div>
@stop

@section('js')
@endsection
