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
@endsection