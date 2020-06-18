<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Item;
use App\Subcategory;
use App\CategoryItem;

class ItemController extends Controller
{
    public function index()
    {
        if (!Auth::user()->isAdmin()) {
            return view('home');
        }

        $items = Item::orderBy('name', 'asc')->where('status', 'active')->get();
        $subcategories = Subcategory::orderBy('name', 'asc')->where('status', 'active')->get();
        return view('items', ["items" => $items, "subcategories" => $subcategories]);
    }

    public function store(Request $request)
    {
        $item = Item::create([
            'name' => $request['name'],
            'status' => 'active',
        ]);

        $categories = $request->input("categories");
        if (!empty($categories)) {
            foreach ($categories as $category) {
                $subcategory = Subcategory::find($category);
                $subcategory->item_count = $subcategory->item_count + 1;
                $subcategory->save();

                CategoryItem::create([
                    'sub' => $category,
                    'item' => $item->id
                ]);
            }
        }
        return redirect('/items');
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);
        if (!Auth::User()->isAdmin()) {
            return view('home');
        }

        $sub_item = $item->subcategories();
        $subcategories = Subcategory::orderBy('name', 'asc')->where('status', 'active')->get();
        $items = Item::orderBy('name', 'asc')->where('status', 'active')->get();
        return view('items', ["items" => $items, "subcategories" => $subcategories, "item_edition" => $item, "sub_item" => $sub_item]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect('register')
                ->withErrors($validator)
                ->withInput();
        }

        $item = Item::find($id);
        $item->name = $request['name'];
        $item->save();

        $previous = $item->subcategories();

        foreach ($previous as $c) {
            CategoryItem::DeleteRelation($item->id, $c->sub);
            $subcategory = Subcategory::find($c->sub);
            $subcategory->item_count = $subcategory->item_count - 1;
            $subcategory->save();
        }

        $categories = $request->input("categories");

        foreach ($categories as $category) {
            $subcategory = Subcategory::find($category);
            $subcategory->item_count = $subcategory->item_count + 1;
            $subcategory->save();

            CategoryItem::create([
                'sub' => $category,
                'item' => $item->id
            ]);
        }

        return redirect('/items');
    }

    public function delete($id)
    {
        $item = Item::findOrFail($id);
        $item->status = "inactive";
        $item->update();

        $previous = $item->subcategories();
        foreach ($previous as $c) {
            CategoryItem::DeleteRelation($item->id, $c->sub);
        }

        foreach ($previous as $c) {
            $subcategory = Subcategory::find($c->sub);
            $subcategory->item_count = $subcategory->item_count - 1;
            $subcategory->save();
        }

        return redirect('/items');
    }
}
