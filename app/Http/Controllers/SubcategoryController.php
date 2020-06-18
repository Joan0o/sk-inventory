<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Subcategory;
use App\Category;

class SubcategoryController extends Controller
{
    public function index()
    {
        if (!Auth::user()->isAdmin()) {
            return view('home');
        }

        $subcategories = Subcategory::orderBy('name', 'asc')->where('status', 'active')->get();
        $categories = Category::orderBy('name', 'asc')->where('status', 'active')->get();
        return view('subcategories', ["subcategories" => $subcategories, "categories" => $categories]);
    }

    public function store(Request $request)
    {
        Subcategory::create([
            'name' => $request['name'],
            'status' => 'active',
            'item_count' => 0,
            'category_id' => $request['category']
        ]);
        return redirect('/subcategories');
    }

    public function edit($id)
    {
        $category = Subcategory::findOrFail($id);
        if (!Auth::User()->isAdmin()) {
            return view('home');
        }

        $categories = Category::orderBy('name', 'asc')->where('status', 'active')->get();
        $subcategories = Subcategory::orderBy('name', 'asc')->where('status', 'active')->get();
        return view('subcategories', ["subcategories" => $subcategories, "categories" => $categories, "subcategory_edition" => $category]);
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

        $subcategory = Subcategory::find($id);

        $subcategory->name = $request['name'];
        $subcategory->category_id = $request['category'];

        $subcategory->save();

        return redirect('/subcategories');
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->status = "inactive";
        $category->update();

        return redirect('/subcategories');
    }
}
