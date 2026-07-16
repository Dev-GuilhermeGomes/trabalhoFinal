@extends('layouts.app')

@section('title', 'Editar Jogo')

@section('content')
    <h1 class="page-title">Editar {{ $game->name }}</h1>

    <form method="POST" action="{{ route('games.update', $game) }}" enctype="multipart/form-data" class="form-box">
        @csrf
        @method('PUT')

        <label for="name">Nome do jogo</label>
        <input type="text" name="name" id="name" value="{{ old('name', $game->name) }}" required>

        <label for="cover_image">Capa (deixa vazio para manter a atual)</label>
        <input type="file" name="cover_image" id="cover_image">

        @if($game->cover_image)
            <img src="{{ asset('storage/'.$game->cover_image) }}" width="100" style="margin-top:10px;border-radius:4px">
        @endif

        <label for="release_date">Data de lançamento</label>
        <input type="date" name="release_date" id="release_date" value="{{ old('release_date', $game->release_date) }}">

        <label for="genre">Género</label>
        <input type="text" name="genre" id="genre" value="{{ old('genre', $game->genre) }}">

        <label for="pegi">PEGI</label>
        <input type="text" name="pegi" id="pegi" value="{{ old('pegi', $game->pegi) }}">

        <label for="platform">Plataforma</label>
        <input type="text" name="platform" id="platform" value="{{ old('platform', $game->platform) }}">

        <button type="submit">Atualizar</button>
    </form>
@endsection