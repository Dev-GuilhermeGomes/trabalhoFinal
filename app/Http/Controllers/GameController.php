<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Studio;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(Request $request, Studio $studio)
    {
        $filters = $request->only(['genre', 'platform', 'release_from', 'release_to']);

        $gamesQuery = $studio->games()
            ->withCount('reviews')
            ->withAvg('reviews', 'rating');

        if (!empty($filters['genre'])) {
            $gamesQuery->where('genre', $filters['genre']);
        }

        if (!empty($filters['platform'])) {
            $gamesQuery->where('platform', $filters['platform']);
        }

        if (!empty($filters['release_from'])) {
            $gamesQuery->whereDate('release_date', '>=', $filters['release_from']);
        }

        if (!empty($filters['release_to'])) {
            $gamesQuery->whereDate('release_date', '<=', $filters['release_to']);
        }

        $games = $gamesQuery
            ->orderBy('release_date', 'desc')
            ->orderBy('name')
            ->paginate(6)
            ->withQueryString();

        $genres = $studio->games()
            ->whereNotNull('genre')
            ->distinct()
            ->orderBy('genre')
            ->pluck('genre');

        $platforms = $studio->games()
            ->whereNotNull('platform')
            ->distinct()
            ->orderBy('platform')
            ->pluck('platform');

        return view('games.index', compact('studio', 'games', 'genres', 'platforms', 'filters'));
    }

    public function show(Game $game)
    {
        $game->load(['studio', 'reviews.user']);

        return view('games.show', compact('game'));
    }

    public function storeReview(Request $request, Game $game)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $game->reviews()->updateOrCreate(
            ['user_id' => $request->user()->id],
            [
                'rating' => $validated['rating'],
                'comment' => $validated['comment'] ?? null,
            ]
        );

        return redirect()->route('games.show', $game)->with('success', 'A tua review foi guardada.');
    }

    public function create(Studio $studio)
    {
        return view('games.create', compact('studio'));
    }

    public function store(Request $request, Studio $studio)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'cover_image' => 'nullable|image|max:2048',
            'release_date' => 'nullable|date',
            'genre' => 'nullable|string|max:255',
            'pegi' => 'nullable|string|max:10',
            'platform' => 'nullable|string|max:50',
        ]);

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('games', 'public');
        }

        $studio->games()->create($validated);

        return redirect()->route('games.index', $studio)->with('success', 'Jogo criado com sucesso.');
    }

    public function edit(Game $game)
    {
        return view('games.edit', compact('game'));
    }

    public function update(Request $request, Game $game)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'cover_image' => 'nullable|image|max:2048',
            'release_date' => 'nullable|date',
            'genre' => 'nullable|string|max:255',
            'pegi' => 'nullable|string|max:10',
            'platform' => 'nullable|string|max:50',
        ]);

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('games', 'public');
        }

        $game->update($validated);

        return redirect()->route('games.index', $game->studio)->with('success', 'Jogo atualizado.');
    }

    public function destroy(Game $game)
    {
        $studio = $game->studio;
        $game->delete();
        return redirect()->route('games.index', $studio)->with('success', 'Jogo apagado.');
    }
}