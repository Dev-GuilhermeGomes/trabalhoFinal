@extends('layouts.app')

@section('title', 'Editar Estúdio')

@section('content')
    <h1 class="page-title">Editar {{ $studio->name }}</h1>

    <form method="POST" action="{{ route('admin.studios.update', $studio) }}" enctype="multipart/form-data" class="form-box">
        @csrf
        @method('PUT')

        <label for="name">Nome</label>
        <input type="text" name="name" id="name" value="{{ old('name', $studio->name) }}" required>

        <label for="logo">Logo (deixa vazio para manter a atual)</label>
        <input type="file" name="logo" id="logo">

        @if($studio->logo)
            <img src="{{ asset('storage/'.$studio->logo) }}" width="100" style="margin-top:10px;border-radius:4px">
        @endif

        <button type="submit">Atualizar</button>
    </form>
@endsection