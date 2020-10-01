@extends('layouts.auth')

@section('content')

<section class="vh-lg-100 d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center form-bg-image" data-background-lg="{{ url('img/signin.svg') }}" style="background: url(&quot;{{ url('img/signin.svg') }}&quot;);">
            <div class="col-12 d-flex align-items-center justify-content-center">
                <div class="signin-inner my-3 my-lg-0 bg-white shadow-soft border rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                    <div class="text-center text-md-center mb-4 mt-md-0">
                        <h1 class="mb-0 h3">{{ __('Login') }}</h1>
                    </div>
                    <form method="POST" action="{{ route('login') }}" class="mt-4" data-nordpass-autofill="login" data-nordpass-watching="1">
                        @csrf
                        <div class="form-group mb-4"><label for="email">{{ __('E-Mail Address') }}</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <span class="fas fa-envelope"></span>
                                </span>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="ex@email.com" autofocus="" required="" autocomplete="off">
                                </span>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group mb-4">
                                <label for="password">{{ __('Password') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon2">
                                        <span class="fas fa-unlock-alt"></span>
                                    </span>
                                    <input id="password" name="password" required type="password" placeholder="{{ __('Password') }}" class="form-control @error('password') is-invalid @enderror" autocomplete="off" >
                                    </span>

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>

                                </div>
                                <div>
                                    @if (Route::has('password.request'))
                                    <a class="small text-right" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                    @endif

                                </div>
                            </div>
                        </div><button type="submit" class="btn btn-block btn-primary">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection



