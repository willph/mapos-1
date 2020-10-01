@extends('layouts.app')

@section('title', __('messages.customers'))

@section('content_header')

<div class="d-flex justify-content-between w-100 flex-wrap">
    <div class="mb-3 mb-lg-0">
        <h2>{{ __('messages.customers') }}</h2>
    </div>
    <div><a class="btn btn-success" href="{{ route('admin.customers.create') }}">{{ __('messages.create_customer') }}</a></div>
</div>

@stop

@section('content')
<div class="table-responsive p-3">
    <table class="table table-centered table-nowrap mb-0">
        <thead class="thead-light">
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">{{ __('messages.name') }}</th>
                <th class="text-center">{{ __('messages.document_number') }}</th>
                <th class="text-center">{{ __('messages.phone_number') }}</th>
                <th class="text-center">{{ __('messages.email') }}</th>
                <th class="text-center">{{ __('messages.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($customers as $customer)
            <tr class="text-center">
                <td>{{ $customer->getKey() }}</td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->document_number }}</td>
                <td>{{ $customer->phone_number }}</td>
                <td>{{ $customer->email }}</td>
                <td>

                    <form action="{{ route('admin.customers.destroy',$customer->getKey()) }}" method="POST">
                        <a class="btn btn-xs btn-primary" href="{{ route('admin.customers.show', $customer) }}">
                            {{ __('messages.view') }}
                        </a>
                        <a class="btn btn-xs btn-info" href="{{ route('admin.customers.edit', $customer) }}">
                            {{ __('messages.edit') }}
                        </a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Deseja realmente excluir este registro?') ">{{ __('messages.delete') }}</button>
                    </form>

                </td>
            </tr>
            @empty
            <tr class="text-center">
                <td colspan="6">{{ __('messages.no_records') }}</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center">
    {{ $customers->links() }}
</div>
@stop
