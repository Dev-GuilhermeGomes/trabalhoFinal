@extends('layouts.app')

@section('title', 'Nova password')

@section('content')
    <div class="auth-shell">
        <section class="auth-hero">
            <span class="auth-eyebrow">Nova password</span>
            <h1>Define uma password nova e volta a entrar sem complicações.</h1>
            <p>Usa uma combinação forte e única para manter a tua conta segura.</p>
            <ul>
                <li>Confirma o teu email</li>
                <li>Escolhe uma nova password</li>
                <li>Reentra na aplicação de imediato</li>
            </ul>
        </section>

        <section class="auth-card">
            <h2>Atualizar password</h2>

            @if ($errors->any())
                <div class="error-box">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}" class="auth-form">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $request->email) }}" required autofocus>

                <label for="password">Nova password</label>
                <input type="password" name="password" id="password" required>

                <label for="password_confirmation">Confirmar nova password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>

                <button type="submit" class="auth-submit">Guardar nova password</button>
            </form>
        </section>
    </div>
@endsection
