@extends('layouts.app')

@section('title', 'Novo Estúdio')

@section('content')
    <h1 class="page-title">Novo Estúdio</h1>

    <form method="POST" action="{{ route('admin.studios.store') }}" enctype="multipart/form-data" class="form-box">
        @csrf

        <label for="name">Nome</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required>

        <label for="logo">Logo</label>
        <input type="file" name="logo" id="logo">

        @error('name') <p class="field-error">{{ $message }}</p> @enderror

        <button type="submit">Guardar</button>
    </form>
@endsection