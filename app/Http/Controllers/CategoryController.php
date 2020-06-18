<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Category;

class CategoryController extends Controller
{
    public function index()
    {
        if (!Auth::User()->isAdmin()) {
            return view('home');
        }

        $categories = Category::orderBy('name', 'asc')->where('status', 'active')->where('id', '<>', '7')->get();
        return view('categories', ["categories" => $categories]);
    }

    public function store(Request $request)
    {
        Category::create([
            'name' => $request['name'],
            'status' => 'active',
        ]);
        return redirect('/categories');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        if (!Auth::User()->isAdmin()) {
            return view('home');
        }

        $categories = Category::orderBy('name', 'asc')->where('status', 'active')->where('id', '<>', '7')->get();
        return view('categories', ["categories" => $categories, "category_edition" => $category]);
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

        $category = Category::find($id);

        $category->name = $request['name'];

        $category->save();

        $categories = Category::orderBy('name', 'asc')->where('status', 'active')->get();
        return view('categories', ["categories" => $categories]);
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->status = "inactive";
        $category->update();

        return redirect('/categories');
    }
}
