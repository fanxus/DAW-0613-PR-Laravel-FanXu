<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInventoryRequest;
use App\Models\Inventory;
use App\Models\Item;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInventoryRequest  $request)
    {
        if ($request->equipped) {

            $item = Item::find($request->item_id);

            $alreadyEquipped = Inventory::where('character_id', $request->character_id)
                ->where('equipped', true)
                ->whereHas('item', function ($q) use ($item) {
                    $q->where('slot', $item->slot);
                })
                ->exists();

            if ($alreadyEquipped) {
                return back()->withErrors([
                    'equipped' => 'This slot is already occupied.'
                ]);
            }
        }

        Inventory::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
