<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function index()
    {
        return Item::all();
    }
 
    public function show(Item $item)
    {
        return $item;
    }
 
    public function store(Request $request)
    {
        $item = item::create($request->all());
 
        return response()->json($item, 201);
    }
 
    public function update(Request $request, item $item)
    {
        $item->update($request->all());
 
        return response()->json($item, 200);
    }
 
    public function delete(item $item)
    {
        $item->delete();
 
        return response()->json(null, 204);
    }
}
