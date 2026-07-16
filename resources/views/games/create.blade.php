@extends('layouts.app')

@section('title', 'Novo Jogo')

@section('content')
    <h1 class="page-title">Novo Jogo para {{ $studio->name }}</h1>

    <form method="POST" action="{{ route('admin.games.store', $studio) }}" enctype="multipart/form-data" class="form-box">
        @csrf

        <label for="name">Nome do jogo</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required>

        <label for="cover_image">Capa</label>
        <input type="file" name="cover_image" id="cover_image">

        <label for="release_date">Data de lançamento</label>
        <input type="date" name="release_date" id="release_date" value="{{ old('release_date') }}">

        <label for="genre">Género</label>
        <input type="text" name="genre" id="genre" value="{{ old('genre') }}">

        <label for="pegi">PEGI</label>
        <input type="text" name="pegi" id="pegi" value="{{ old('pegi') }}" placeholder="ex: 18">

        <label for="platform">Plataforma</label>
        <input type="text" name="platform" id="platform" value="{{ old('platform') }}" placeholder="PS4, PS5">

        <button type="submit">Guardar</button>
    </form>
@endsection