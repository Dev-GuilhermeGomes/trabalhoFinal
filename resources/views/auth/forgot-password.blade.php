@extends('layouts.app')

@section('title', 'Recuperar password')

@section('content')
    <div class="auth-shell">
        <section class="auth-hero">
            <span class="auth-eyebrow">Recuperação de acesso</span>
            <h1>Enviaremos um link para voltares a entrar na tua conta.</h1>
            <p>É rápido, seguro e segue o mesmo visual tranquilo da aplicação.</p>
            <ul>
                <li>Recebe o link no email</li>
                <li>Define uma nova password</li>
                <li>Retoma o acesso em poucos segundos</li>
            </ul>
        </section>

        <section class="auth-card">
            <h2>Recuperar password</h2>

            @if (session('status'))
                <div class="success-box">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="error-box">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="auth-form">
                @csrf

                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus>

                <button type="submit" class="auth-submit">Enviar link de recuperação</button>
            </form>

            <p class="auth-footer"><a href="{{ route('login') }}">Voltar ao login</a></p>
        </section>
    </div>
@endsection
