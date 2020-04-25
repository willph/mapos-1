@extends('adminlte::page')

@section('title', @trans('messages.customers'))

@section('content_header')
    <div class="p-2">
        <div class="float-left">
            <h2>{{ @trans('messages.customers') }}</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-xs btn-primary btn-" href="{{ route('admin.customers.create') }}">{{ @trans('messages.create_customer') }}</a>
        </div>
    </div>
@stop

@section('content')
    <div class="box p-2">
        <!-- /.box-header -->
        <div class="box-body mt-4">
            <table class="table table-bordered table-condensed">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">{{ @trans('messages.name') }}</th>
                    <th class="text-center">{{ @trans('messages.document_number') }}</th>
                    <th class="text-center">{{ @trans('messages.phone_number') }}</th>
                    <th class="text-center">{{ @trans('messages.email') }}</th>
                    <th class="text-center">{{ @trans('messages.actions') }}</th>
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
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.customers.show', $customer) }}">
                                {{ @trans('messages.view') }}
                            </a>
                            <a class="btn btn-xs btn-warning" href="{{ route('admin.customers.edit', $customer) }}">
                                {{ @trans('messages.edit') }}
                            </a>
                            <button type="button" class="btn btn-xs btn-danger destroy" data-id="{{ $customer->getKey() }}">
                                {{ @trans('messages.delete') }}
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr class="text-center">
                        <td colspan="6">{{ @trans('messages.no_records') }}</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {{ $customers->links() }}
        </div>
    </div>
@stop

@section('js')
 <script>
     $(function() {
         $('.destroy').on('click', function () {
             var id = $(this).data('id');
             Swal.fire({
                 title: "{{ @trans('messages.confirm_customer_delete') }}",
                 confirmButtonText: "{{ @trans('messages.confirm') }}",
                 cancelButtonText: "{{ @trans('messages.cancel') }}",
                 showCancelButton: true,
                 showCloseButton: true
             })
             .then((confirm) => {
                 if (!confirm.value) {
                     return;
                 }

                 $.ajax({
                     url: "{{ route('admin.customers.destroy', '_id') }}".replace('_id', id),
                     method: 'DELETE',
                     data: {
                        "_token": "{{ csrf_token() }}"
                     },
                     success: function (xhr) {
                         Swal.fire({
                             icon: 'success',
                             title: "{{ @trans('messages.customer_deleted_success') }}",
                             showConfirmButton: false,
                             timer: 1500
                         })
                         .then(() => {
                             window.location.reload();
                         });
                     },
                     error: function (xhr) {
                         Swal.fire({
                             icon: 'error',
                             title: "{{ @trans('messages.customer_deleted_fail') }}",
                             showConfirmButton: true,
                             timer: 1500
                         });
                     }
                 });
             });
         })
     });
 </script>
@endsection
