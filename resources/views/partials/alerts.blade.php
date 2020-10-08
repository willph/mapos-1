@if (Session::has('alert-success'))
<div class="alert alert-success mb-2 text-white">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {!! Session::get('alert-success') !!}
</div>
@endif

@if (Session::has('alert-error'))
<div class="alert alert-danger mb-2">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {!! Session::get('alert-error') !!}
</div>
@endif
