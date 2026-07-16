<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class StudioController extends Controller
{
    public function index()
    {
        $studios = Studio::withCount('games')->paginate(6);
        return view('studios.index', compact('studios'));
    }

    public function create()
    {
        return view('studios.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('studios', 'public');
        }

        Studio::create($validated);

        return redirect()->route('studios.index')->with('success', 'Estúdio criado com sucesso.');
    }

    public function edit(Studio $studio)
    {
        return view('studios.edit', compact('studio'));
    }

    public function update(Request $request, Studio $studio)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('studios', 'public');
        }

        $studio->update($validated);

        return redirect()->route('studios.index')->with('success', 'Estúdio atualizado.');
    }

    public function destroy(Studio $studio)
    {
        $studio->delete();
        return redirect()->route('studios.index')->with('success', 'Estúdio apagado.');
    }
}