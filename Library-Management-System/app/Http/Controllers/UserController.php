<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Illuminate\Validation\Rule;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $profile)
    {    
        // dd($profile->id);
        // dd(Auth::user()->id);
        // dd($profile->name);
        $this->authorize('edit',$profile);       
        return view('user.index')->with('profile' ,$profile);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $profile)
    {
        $this->authorize('update',$profile);
       $validateDate = $request->validate([
            'name'=>'required',
            'username'=>['required', Rule::unique('users')->ignore($profile)],
            'New_Password'=>'nullable|required_with:password|confirmed|min:6',
            'email'=>['required', Rule::unique('users')->ignore($profile)]
            // 'profile_picture'=>'nullable|image|mimes:jpeg,png,jpg,svg|max:5048',
        ]);
        $profile->update($request->all());
        // $user->name  = $request->name;
        // $user->username=$request->username;
        // $user->save();
        return redirect("/home");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
