<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    // GET /api/items
    public function index()
    {
        return response()->json(Item::all());
    }

    // POST /api/items
    public function store(Request $request)
    {
        $item = Item::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return response()->json($item, 201);
    }
}
