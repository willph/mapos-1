@extends('adminlte::page')

@section('title', @trans('messages.view_service'))

@section('content_header')
    <div class="p-2">
        <h2>{{ @trans('messages.view_service') }}</h2>
    </div>
@stop

@section('content')
    <div class="card card-primary p-4">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <td class="w-50">{{ @trans('messages.name') }}</td>
                    <td class="w-50">{{ $service->name }}</td>
                </tr>
                <tr>
                    <td class="w-50">{{ @trans('messages.description') }}</td>
                    <td class="w-50">{{ $service->description }}</td>
                </tr>
                <tr>
                    <td class="w-50">{{ @trans('messages.price') }}</td>
                    <td class="w-50">{{ $service->price }}</td>
                </tr>
                <tr>
                    <td class="w-50">{{ @trans('messages.created_at') }}</td>
                    <td class="w-50">@datetime($service->created_at)</td>
                </tr>
                <tr>
                    <td class="w-50">{{ @trans('messages.updated_at') }}</td>
                    <td class="w-50">@datetime($service->updated_at)</td>
                </tr>
            </tbody>
        </table>

        <div class="mt-3">
            <a href="{{ route('admin.services.index') }}" class="btn btn-primary">{{ @trans('messages.go_back') }}</a>
        </div>
    </div>
@stop

@section('js')
@endsection
