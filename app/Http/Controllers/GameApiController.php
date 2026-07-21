<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Http\Resources\GameResource;
use Illuminate\Http\Request;

class GameApiController extends Controller
{
    public function index()
    {
        return GameResource::collection(Game::paginate(10));
    }

    public function store(Request $request)
    {
        $request->validate([
            'studio_id' => 'required|exists:studios,id',
            'name' => 'required|string',
        ]);

        $game = Game::create($request->all());

        return new GameResource($game);
    }

    public function show(Game $game)
    {
        return new GameResource($game);
    }

    public function update(Request $request, Game $game)
    {
        $game->update($request->all());

        return new GameResource($game);
    }

    public function destroy(Game $game)
    {
        $game->delete();

        return response()->json('deleted');
    }
}