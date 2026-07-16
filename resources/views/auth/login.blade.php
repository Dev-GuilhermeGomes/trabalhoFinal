@extends('layouts.app')

@section('title', 'Login')

@section('content')

    <div class="auth-container">
        <h1>Login</h1>

        @if ($errors->any())
            <div class="error-box">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>

            <label>
                <input type="checkbox" name="remember"> Lembrar-me
            </label>

            <button type="submit">Entrar</button>
        </form>

        <p>Não tens conta? <a href="{{ route('register') }}">Regista-te aqui</a></p>
    </div>

@endsection
