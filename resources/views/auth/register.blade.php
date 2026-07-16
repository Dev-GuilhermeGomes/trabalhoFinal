@extends('layouts.app')

@section('title', 'Registo')

@section('content')
    <div class="auth-container">
        <h1>Criar Conta</h1>

        @if ($errors->any())
            <div class="error-box">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <label for="name">Nome</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>

            <label for="password_confirmation">Confirmar Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>

            <button type="submit">Registar</button>
        </form>

        <p>Já tens conta? <a href="{{ route('login') }}">Entra aqui</a></p>
    </div>

@endsection