@extends('adminlte::page')

@section('title', @trans('messages.view_user'))

@section('content_header')
    <div class="p-2">
        <h2>{{ @trans('messages.view_user') }}</h2>
    </div>
@stop

@section('content')
    <div class="card card-primary p-4">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <td class="w-50">{{ @trans('messages.name') }}</td>
                    <td class="w-50">{{ $user->name }}</td>
                </tr>
                <tr>
                    <td class="w-50">{{ @trans('messages.email') }}</td>
                    <td class="w-50">{{ $user->email }}</td>
                </tr>
                <tr>
                    <td class="w-50">{{ @trans('messages.created_at') }}</td>
                    <td class="w-50">@datetime($user->created_at)</td>
                </tr>
                <tr>
                    <td class="w-50">{{ @trans('messages.updated_at') }}</td>
                    <td class="w-50">@datetime($user->updated_at)</td>
                </tr>
            </tbody>
        </table>

        <div class="mt-3">
            <a href="{{ route('admin.users.index') }}" class="btn btn-primary">{{ @trans('messages.go_back') }}</a>
        </div>
    </div>
@stop

@section('js')
@endsection
