<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCharacterRequest;
use App\Models\Character;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $characters = Character::orderBy('id', 'desc')->paginate(10);

        return response()->json($characters);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCharacterRequest $request)
    {
        $character = Character::create($request->validated());
        return response()->json([
            'message' => 'Character created successfully',
            'character' => $character,
        ], 201);

        // $data = $request->validated();

        // $character = new Character($data);

        // $character->user()->associate(Auth::user());

        // $character->save();

        // return response()->json($character, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return Character::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
