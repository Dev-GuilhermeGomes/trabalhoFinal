@extends('layouts.app')

@section('title', $game->name)

@section('content')
    <a href="{{ route('games.index', $game->studio) }}" class="back-link">← Voltar aos jogos</a>

    <div class="game-detail">
        <div class="game-hero">
            <img src="{{ $game->cover_image ? asset('storage/' . $game->cover_image) : 'https://via.placeholder.com/600x320?text=Sem+Imagem' }}" alt="{{ $game->name }}">
        </div>

        <div class="game-info card-body">
            <h1 class="page-title">{{ $game->name }}</h1>
            <p><strong>Estúdio:</strong> {{ $game->studio->name }}</p>
            <p><strong>Lançamento:</strong> {{ $game->release_date ? \Carbon\Carbon::parse($game->release_date)->format('d/m/Y') : 'N/D' }}</p>
            <p><strong>Género:</strong> {{ $game->genre ?? 'N/D' }}</p>
            <p><strong>PEGI:</strong> {{ $game->pegi ?? 'N/D' }}</p>
            <p><strong>Plataforma:</strong> {{ $game->platform ?? 'N/D' }}</p>
            <p><strong>Média:</strong> {{ $game->reviews->count() ? number_format($game->reviews->avg('rating'), 1) . '/5' : 'Sem reviews' }}</p>

            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('games.edit', $game) }}" class="btn">Editar</a>
                    <form action="{{ route('admin.games.destroy', $game) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-danger" onclick="return confirm('Tens a certeza?')">Apagar</button>
                    </form>
                @endif
            @endauth
        </div>
    </div>

    <section class="reviews-section">
        <h2 class="section-title">Reviews</h2>

        @auth
            <form method="POST" action="{{ route('games.reviews.store', $game) }}" class="review-form">
                @csrf

                <label for="rating">A tua classificação</label>
                <div class="star-input" aria-label="Classificação de 1 a 5 estrelas">
                    @for ($rating = 5; $rating >= 1; $rating--)
                        <input type="radio" id="rating-{{ $rating }}" name="rating" value="{{ $rating }}" @checked(old('rating', 5) == $rating)>
                        <label for="rating-{{ $rating }}">★</label>
                    @endfor
                </div>

                <label for="comment">Comentário opcional</label>
                <textarea name="comment" id="comment" rows="4" placeholder="Deixa uma nota sobre o jogo...">{{ old('comment') }}</textarea>

                <button type="submit" class="btn-primary">Guardar review</button>
            </form>
        @else
            <p class="review-login">Faz login para deixares a tua review.</p>
        @endauth

        <div class="review-list">
            @forelse($game->reviews as $review)
                <article class="review-card">
                    <div class="review-header">
                        <strong>{{ $review->user->name }}</strong>
                        <span>{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}</span>
                    </div>
                    @if($review->comment)
                        <p>{{ $review->comment }}</p>
                    @endif
                    <small>{{ $review->created_at->format('d/m/Y H:i') }}</small>
                </article>
            @empty
                <p>Ainda não existem reviews para este jogo.</p>
            @endforelse
        </div>
    </section>
@endsection
