@extends('layouts.app')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap');

    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Montserrat', sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #333;
    }

    .page-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 1rem;
        box-sizing: border-box;
    }

    .register-card {
        background-color: #fff;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        padding: 2rem;
        max-width: 480px;
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 1rem;
        transition: transform 0.3s ease;
    }

    .register-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.2);
    }

    .register-title {
        font-weight: 700;
        font-size: 2rem;
        margin-bottom: 1rem;
        text-align: center;
        color: #333;
        letter-spacing: 1.1px;
    }

    label {
        font-weight: 600;
        font-size: 1rem;
        margin-bottom: 0.35rem;
        color: #555;
        display: block;
    }

    input.form-control {
        border: 2px solid #ddd;
        border-radius: 12px;
        padding: 12px 14px;
        font-size: 1.1rem;
        width: 100%;
        margin-bottom: 1rem;
        transition: border-color 0.3s ease;
    }

    input.form-control:focus {
        border-color: #764ba2;
        outline: none;
        box-shadow: 0 0 8px rgba(118, 75, 162, 0.5);
    }

    .btn-primary {
        background: #764ba2;
        border: none;
        border-radius: 12px;
        padding: 12px 0;
        width: 100%;
        font-weight: 700;
        font-size: 1.2rem;
        color: white;
        cursor: pointer;
        transition: background 0.3s ease;
        margin-top: 0.3rem;
    }

    .btn-primary:hover {
        background: #5a3680;
    }

    .invalid-feedback {
        color: #e74c3c;
        font-size: 0.9rem;
        margin-top: -0.75rem;
        margin-bottom: 0.8rem;
    }

    @media (max-width: 576px) {
        .register-card {
            max-width: 90%;
            padding: 1.2rem 1.5rem;
        }
    }
</style>

<div class="page-wrapper">
    <div class="register-card" role="main" aria-label="Register form">
        <h2 class="register-title">{{ __('Register') }}</h2>

        <form method="POST" action="{{ route('register') }}" novalidate>
            @csrf

            <label for="name">{{ __('Name') }}</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                aria-invalid="@error('name')true @else false @enderror">

            @error('name')
                <div class="invalid-feedback" role="alert">{{ $message }}</div>
            @enderror

            <label for="email">{{ __('Email Address') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                name="email" value="{{ old('email') }}" required autocomplete="email"
                aria-invalid="@error('email')true @else false @enderror">

            @error('email')
                <div class="invalid-feedback" role="alert">{{ $message }}</div>
            @enderror

            <label for="password">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="new-password"
                aria-invalid="@error('password')true @else false @enderror">

            @error('password')
                <div class="invalid-feedback" role="alert">{{ $message }}</div>
            @enderror

            <label for="password-confirm">{{ __('Confirm Password') }}</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

            <button type="submit" class="btn-primary" aria-label="Register an account">
                {{ __('Register') }}
            </button>
        </form>
    </div>
</div>
@endsection
