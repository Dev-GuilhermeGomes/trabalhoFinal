@extends('layouts.app')

@section('title', 'Jogos - ' . $studio->name)

@section('content')
    <a href="{{ route('studios.index') }}" class="back-link">← Voltar aos estúdios</a>
    <h1 class="page-title">Jogos de {{ $studio->name }}</h1>

    @auth
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.games.create', $studio) }}" class="btn-primary">+ Novo Jogo</a>
        @endif
    @endauth

    <form method="GET" action="{{ route('games.index', $studio) }}" class="filter-bar">
        <div class="filter-group">
            <label for="genre">Género</label>
            <select name="genre" id="genre">
                <option value="">Todos</option>
                @foreach($genres as $genre)
                    <option value="{{ $genre }}" @selected(($filters['genre'] ?? '') === $genre)>{{ $genre }}</option>
                @endforeach
            </select>
        </div>

        <div class="filter-group">
            <label for="platform">Plataforma</label>
            <select name="platform" id="platform">
                <option value="">Todas</option>
                @foreach($platforms as $platform)
                    <option value="{{ $platform }}" @selected(($filters['platform'] ?? '') === $platform)>{{ $platform }}</option>
                @endforeach
            </select>
        </div>

        <div class="filter-group">
            <label for="release_from">Lançado de</label>
            <input type="date" name="release_from" id="release_from" value="{{ $filters['release_from'] ?? '' }}">
        </div>

        <div class="filter-group">
            <label for="release_to">até</label>
            <input type="date" name="release_to" id="release_to" value="{{ $filters['release_to'] ?? '' }}">
        </div>

        <div class="filter-actions">
            <button type="submit" class="btn-primary">Filtrar</button>
            <a href="{{ route('games.index', $studio) }}" class="btn-primary filter-reset">Limpar</a>
        </div>
    </form>

    <div class="card-grid">
        @forelse($games as $game)
            <div class="card">
                <img src="{{ $game->cover_image ? asset('storage/' . $game->cover_image) : 'https://via.placeholder.com/300x160?text=Sem+Imagem' }}"
                    alt="{{ $game->name }}">
                <div class="card-body">
                    <h3>{{ $game->name }}</h3>
                    <p>Lançamento:
                        {{ $game->release_date ? \Carbon\Carbon::parse($game->release_date)->format('d/m/Y') : 'N/D' }}</p>
                    <p>Género: {{ $game->genre ?? 'N/D' }}</p>
                    <p>PEGI: {{ $game->pegi ?? 'N/D' }} | Plataforma: {{ $game->platform ?? 'N/D' }}</p>
                    <p>
                        Classificação:
                        {{ $game->reviews_count ? number_format((float) $game->reviews_avg_rating, 1) . '/5' : 'Sem reviews' }}
                    </p>

                    <a href="{{ route('games.show', $game) }}" class="btn">Ver detalhes</a>

                    @auth
                        <a href="{{ route('games.edit', $game) }}" class="btn">Editar</a>
                        @if(auth()->user()->role === 'admin')
                            <form action="{{ route('admin.games.destroy', $game) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger" onclick="return confirm('Tens a certeza?')">Apagar</button>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>
        @empty
            <p>Ainda não há jogos registados para este estúdio.</p>
        @endforelse
    </div>

    <div class="pagination">
        {{ $games->links() }}
    </div>
@endsection