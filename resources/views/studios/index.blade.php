@extends('layouts.app')

@section('title', 'Estúdios')

@section('content')
    <h1 class="page-title">Estúdios PlayStation</h1>

    @auth
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.studios.create') }}" class="btn-primary">+ Novo Estúdio</a>
        @endif
    @endauth

    <div class="card-grid">
        @foreach($studios as $studio)
            <div class="card">
                <img src="{{ $studio->logo ? asset('storage/' . $studio->logo) : 'https://via.placeholder.com/300x160?text=Sem+Imagem' }}"
                    alt="{{ $studio->name }}">
                <div class="card-body">
                    <h3>{{ $studio->name }}</h3>
                    <p>{{ $studio->games_count }} jogo(s)</p>
                    <a href="{{ route('games.index', $studio) }}" class="btn">Ver jogos</a>

                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.studios.edit', $studio) }}" class="btn">Editar</a>
                            <form action="{{ route('admin.studios.destroy', $studio) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger" onclick="return confirm('Tens a certeza?')">Apagar</button>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>
        @endforeach
    </div>

    <div class="pagination">
        {{ $studios->links() }}
    </div>
@endsection