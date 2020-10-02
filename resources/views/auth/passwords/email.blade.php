@extends('layouts.auth')

@section('content')
<section class="vh-lg-100 bg-soft d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center form-bg-image">
            <div class="col-12 d-flex align-items-center justify-content-center">
                <div class="signin-inner my-3 my-lg-0 bg-white shadow-soft border rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                    <h1 class="h3">{{ __('auth.reset') }}</h1>
                    @if (session('status'))
                    <div class="alert alert-success text-white" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="mb-4"><label for="email">{{ __('auth.email') }}</label>
                            <div class="input-group">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required="" placeholder="{{ __('auth.email') }}" autofocus="" autocomplete="off">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-block btn-primary">{{ __('auth.send_reset_link') }}</button>
                    </form>
                    <div class="d-flex justify-content-center align-items-center mt-4"><span class="font-weight-normal">{{ __('auth.go_back') }} <a href="{{ route('login') }}" class="font-weight-bold">{{ __('auth.login_page') }}</a></span></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


