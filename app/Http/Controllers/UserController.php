<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        if (!Auth::user()->isAdmin()) {
            return view('home');
        }

        $users = User::orderBy('name', 'asc')->where('status', 'active')->get();
        return view('auth.register', ["users" => $users, "user_edition" => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        if($request['password'] != ""){
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
            ]);
    
            if ($validator->fails()) {
                return redirect('register')
                    ->withErrors($validator)
                    ->withInput();
            }  
        }
        
        $user = User::find($id);

        $user->name = $request['name'];
        $user->password = Hash::make($request['password']);

        $user->save();

        $users = User::orderBy('name', 'asc')->where('status', 'active')->get();
        return view('auth.register', ["users" => $users]);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->status = "inactive";
        $user->update();

        return redirect('/register');
    }
}
