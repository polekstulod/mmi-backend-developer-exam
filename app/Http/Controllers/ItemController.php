<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Retrieve search parameters from the request
        $name = $request->input('name');
        $description = $request->input('description');

        // Query items based on search parameters
        $items = Item::query();

        if ($name) {
            $items->where('name', 'like', "%$name%");
        }

        if ($description) {
            $items->where('description', 'like', "%$description%");
        }

        // Get the results
        $items = $items->get();
        return response()->json($items);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->headers->set('Accept', 'application/json');

        // Validate the request.
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer'
        ]);

        $item = Item::create($validatedData);
        return response()->json($item);
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $id)
    {
        return response()->json($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $id)
    {
        $request->headers->set('Accept', 'application/json');

        $item = Item::find($id);

        // Validate the request.
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer'
        ]);


        $item->update($validatedData);
        return response()->json($item);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $id)
    {
        $item = Item::find($id);
        $item->delete();
        return response()->json(null, 204);
    }
}
