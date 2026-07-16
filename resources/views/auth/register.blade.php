@extends('layouts.app')

@section('title', 'Registo')

@section('content')
    <div class="auth-shell">
        <section class="auth-hero">
            <span class="auth-eyebrow">Junta-te à comunidade</span>
            <h1>Criar conta é rápido e dá-te acesso a tudo o que a app oferece.</h1>
            <p>Faz o teu registo para guardares reviews, navegarem os jogos e voltarem sempre ao teu painel.</p>
            <ul>
                <li>Guarda a tua identidade na app</li>
                <li>Deixa classificações de 1 a 5 estrelas</li>
                <li>Interface pensada para uso diário</li>
            </ul>
        </section>

        <section class="auth-card">
            <h2>Criar conta</h2>

            @if ($errors->any())
                <div class="error-box">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="auth-form">
                @csrf

                <label for="name">Nome</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus>

                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required>

                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>

                <label for="password_confirmation">Confirmar Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>

                <button type="submit" class="auth-submit">Registar</button>
            </form>

            <p class="auth-footer">Já tens conta? <a href="{{ route('login') }}">Entra aqui</a></p>
        </section>
    </div>

@endsection