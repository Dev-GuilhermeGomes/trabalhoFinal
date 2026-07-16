@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h1 class="page-title">Olá, {{ auth()->user()->name }}</h1>
    <p>Bem-vindo à tua área reservada.</p>

    @if(auth()->user()->role === 'admin')
        <p>És administrador — podes gerir estúdios e jogos.</p>
    @else
        <p>Podes editar jogos, mas não apagar estúdios ou jogos.</p>
    @endif

    <section class="dashboard-card">
        <h2>Alterar password</h2>
        <p class="dashboard-note">Usa a tua password actual e define uma nova abaixo.</p>

        @if ($errors->updatePassword->any())
            <div class="error-box">
                <ul>
                    @foreach ($errors->updatePassword->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('status') === 'password-updated')
            <div class="success-box">Password actualizada com sucesso.</div>
        @endif

        <form method="POST" action="{{ route('user-password.update') }}" class="auth-form dashboard-password-form">
            @csrf
            @method('PUT')

            <label for="current_password">Password actual</label>
            <input type="password" name="current_password" id="current_password" required>

            <label for="password">Nova password</label>
            <input type="password" name="password" id="password" required>

            <label for="password_confirmation">Confirmar nova password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>

            <button type="submit" class="auth-submit">Atualizar password</button>
        </form>
    </section>
@endsection