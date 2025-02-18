<?php

namespace App\Http\Controllers;

use App\Rules\CheckAge;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function formUI(){
        return view('form');
    }

    public function index()
    {
        return User::latest()->paginate(5);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
       $validated = $request->validate([
          'name' => 'required|string|max:100',
          'email'=>'required|string|unique:users,email',
          'password'=>'required|string|min:8',
        //   'age' => ['required', new CheckAge],
        ]);

       $data = User::create([
            'name' => $validated['name'],
            'email'=>$validated['email'],
            'password'=>Hash::make($validated['password'])

        ]);
        return redirect()->back()->with('success','stored successfully');
    }

    public function show($userid)
    {
        $value = User::find($userid);
        if($value){
            return response()->json(['searched user'=>$value]);
        }

        return response()->json(['error'=>'cannot find searched info']);
    }


    public function update(Request $request , User $user)
    {

        $validatedinput = $request->validate([

            'name'=>'nullable|string|max:100',
            'email'=>'nullable|string|unique:users,email,'.$user->id,
            'password'=>'nullable|string|min:8'

        ]);

        $user->update($validatedinput);
        return response()->json(['message'=>'user info updated successfully','updated user'=> $user]);
    }


    public function destroy(User $user_id)
    {
        $user_id->delete();
        return response()-> json(['status'=>'User Deleted Successfully']);
    }

    public function showbook(User $user_id){

         return response()->json([ $user_id->load('book')

        ]);
    }

}
