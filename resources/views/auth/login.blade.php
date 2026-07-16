@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="auth-shell">
        <section class="auth-hero">
            <span class="auth-eyebrow">Bem-vindo de volta</span>
            <h1>Entra na tua conta e continua a explorar a coleção PlayStation.</h1>
            <p>Consulta estúdios, descobre jogos e guarda as tuas reviews num espaço simples e confortável.</p>
            <ul>
                <li>Acesso rápido aos teus jogos favoritos</li>
                <li>Reviews com estrelas e comentários</li>
                <li>Interface limpa e fácil de usar</li>
            </ul>
        </section>

        <section class="auth-card">
            <h2>Login</h2>

            @if ($errors->any())
                <div class="error-box">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="auth-form">
                @csrf

                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus>

                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>

                <label class="remember-me">
                    <input type="checkbox" name="remember"> Lembrar-me
                </label>

                <button type="submit" class="auth-submit">Entrar</button>
            </form>

            <p class="auth-footer">Não tens conta? <a href="{{ route('register') }}">Regista-te aqui</a></p>
            <p class="auth-footer auth-footer-secondary"><a href="{{ route('password.request') }}">Esqueceste-te da password?</a></p>
        </section>
    </div>

@endsection
