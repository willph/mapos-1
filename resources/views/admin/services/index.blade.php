@extends('adminlte::page')

@section('title', @trans('messages.services'))

@section('content_header')
    <div class="p-2">
        <div class="float-left">
            <h2>{{ @trans('messages.services') }}</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-xs btn-primary btn-" href="{{ route('admin.services.create') }}">{{ @trans('messages.create_service') }}</a>
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
                    <th class="text-center">{{ @trans('messages.description') }}</th>
                    <th class="text-center">{{ @trans('messages.price') }}</th>
                    <th class="text-center">{{ @trans('messages.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($services as $service)
                    <tr class="text-center">
                        <td>{{ $service->getKey() }}</td>
                        <td>{{ $service->name }}</td>
                        <td>{{ $service->description }}</td>
                        <td>{{ $service->price }}</td>
                        <td>
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.services.show', $service) }}">
                                {{ @trans('messages.view') }}
                            </a>
                            <a class="btn btn-xs btn-warning" href="{{ route('admin.services.edit', $service) }}">
                                {{ @trans('messages.edit') }}
                            </a>
                            <button type="button" class="btn btn-xs btn-danger destroy" data-id="{{ $service->getKey() }}">
                                {{ @trans('messages.delete') }}
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr class="text-center">
                        <td colspan="5">{{ @trans('messages.no_records') }}</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {{ $services->links() }}
        </div>
    </div>
@stop

@section('js')
 <script>
     $(function() {
         $('.destroy').on('click', function () {
             var id = $(this).data('id');
             Swal.fire({
                 title: "{{ @trans('messages.confirm_service_delete') }}",
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
                     url: "{{ route('admin.services.destroy', '_id') }}".replace('_id', id),
                     method: 'DELETE',
                     data: {
                        "_token": "{{ csrf_token() }}"
                     },
                     success: function (xhr) {
                         Swal.fire({
                             icon: 'success',
                             title: "{{ @trans('messages.service_deleted_success') }}",
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
                             title: "{{ @trans('messages.service_deleted_fail') }}",
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
