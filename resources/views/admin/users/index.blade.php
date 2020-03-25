@extends('adminlte::page')

@section('title', @trans('messages.users'))

@section('content_header')
    <div class="p-2">
        <div class="float-left">
            <h2>{{ @trans('messages.users') }}</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-xs btn-primary btn-" href="{{ route('admin.users.create') }}">{{ @trans('messages.create_user') }}</a>
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
                    <th class="text-center">{{ @trans('messages.email') }}</th>
                    <th class="text-center">{{ @trans('messages.name') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr class="text-center">
                        <td>{{ $user->getKey() }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.users.show', $user->id) }}">
                                {{ @trans('messages.view') }}
                            </a>
                            <a class="btn btn-xs btn-warning" href="{{ route('admin.users.edit', $user->id) }}">
                                {{ @trans('messages.edit') }}
                            </a>
                            <button type="button" class="btn btn-xs btn-danger destroy" data-id="{{ $user->id }}">
                                {{ @trans('messages.delete') }}
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    </div>
@stop

@section('js')
 <script>
     $(function() {
         $('.destroy').on('click', function () {
             var id = $(this).data('id');
             Swal.fire({
                 title: "{{ @trans('messages.confirm_user_delete') }}",
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
                     url: '{{ route('admin.users.destroy', '_id') }}'.replace('_id', id),
                     method: 'DELETE',
                     success: function (xhr) {
                         Swal.fire({
                             icon: 'success',
                             title: "{{ @trans('messages.user_deleted_success') }}",
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
                             title: "{{ @trans('messages.user_deleted_fail') }}",
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
