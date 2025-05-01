@extends('layouts.app')

@section('content')
<div class="container animate-main">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card custom-card">
                <div class="card-header bg-white dark:bg-dark-gradient">
                    <h2 class="mb-0 h5 font-semibold text-center">{{ __('Login') }}</h2>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" class="form-animate">
                        @csrf

                        <div class="row mb-4">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                    <input id="email" type="email"
                                           class="form-control input-animate @error('email') is-invalid @enderror"
                                           name="email" value="{{ old('email') }}"
                                           required autocomplete="email" autofocus>
                                </div>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    </div>
                                    <input id="password" type="password"
                                           class="form-control input-animate @error('password') is-invalid @enderror"
                                           name="password" required autocomplete="current-password">
                                </div>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
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
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-animate">
                                    <span class="btn-text">{{ __('Login') }}</span>
                                    <i class="fas fa-sign-in-alt ms-2"></i>
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link btn-animate" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* Form animations */
    .form-animate .row {
        opacity: 0;
        transform: translateY(10px);
        animation: formFadeIn 0.5s ease forwards;
    }

    .form-animate .row:nth-child(1) { animation-delay: 0.2s; }
    .form-animate .row:nth-child(2) { animation-delay: 0.4s; }
    .form-animate .row:nth-child(3) { animation-delay: 0.6s; }
    .form-animate .row:nth-child(4) { animation-delay: 0.8s; }

    @keyframes formFadeIn {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Input animation */
    .input-animate {
        transition: all 0.3s ease;
        border-left: 3px solid transparent;
    }

    .input-animate:focus {
        border-left: 3px solid var(--bs-primary);
        box-shadow: 0 0 0 0.25rem rgba(var(--bs-primary-rgb), 0.25);
    }

    /* Button animation */
    .btn-animate {
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .btn-animate:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .btn-animate:active {
        transform: translateY(1px);
    }

    .btn-animate::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 5px;
        height: 5px;
        background: rgba(255, 255, 255, 0.5);
        opacity: 0;
        border-radius: 100%;
        transform: scale(1, 1) translate(-50%);
        transform-origin: 50% 50%;
    }

    .btn-animate:focus:not(:active)::after {
        animation: ripple 1s ease-out;
    }

    @keyframes ripple {
        0% {
            transform: scale(0, 0);
            opacity: 0.5;
        }
        100% {
            transform: scale(20, 20);
            opacity: 0;
        }
    }
</style>
@endsection
