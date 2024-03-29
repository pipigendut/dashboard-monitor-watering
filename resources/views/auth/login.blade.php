@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <!-- @include('layouts.partials.messages') -->

                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login.perform') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username / Email') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @if ($errors->has('failed')) is-invalid @endif" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @if ($errors->has('failed'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('failed') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary w-50">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="row mt-3">
                        <div class="col-md-12">Don't have an account ?
                            <a href="{{ route('register.perform') }}">Register Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
