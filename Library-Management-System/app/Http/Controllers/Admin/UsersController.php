<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('isAdmin',User::class);
        $users = User::where('id','<>', Auth::id())->get();
        return view('admin.users.index')->with('users', $users);
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('edit', $user);
        return view('admin.users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users,email,'.$user->id,
            'phone' => 'nullable|starts_with:011,012,010,015|digits:11',
            // 'role' => 'sometimes',
            'profile_pic'=>'nullable|file|mimes:jpeg,png,jpg,svg|max:5048',
        ]);

        $this->authorize('update', $user);

        if(($request->name !== null) && ($request->name !== $user->name)) {
            $user->name = $request->name;
        }
        if(($request->email !== null) && ($request->email !== $user->email)) {
            $user->email = $request->email;
        }
        if(($request->phone !== null) && ($request->phone !== $user->phone)) {
            $user->phone = $request->phone;
        }
        elseif ($request->phone == null) {  //user removed his/her phone number
            $user->phone = null;
        }
        if(isset($request->role)) {
            if($request->active == 0){
                return back()->with(['message' => "Cannot Promote an Inactive User to Admin"]);
            }
            else {
                $user->role = "admin"; //promote user
            }
        }
        elseif (!isset($request->role)) {
            $user->role = "user"; //degrade user
        }
        if ($request->profile_pic !== null) {
            $image = $request->file('profile_pic');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();   
            $image->move(public_path('images'), $new_name);
            $user->profile_pic = $new_name;
        }
        
        $user->update();
        return \redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('isAdmin',User::class);
        $user->delete();
        return \redirect()->route('admin.users.index');
    }

    public function handleActiveStatus(Request $request, User $user)
    {
        $user->active == 1 ?  $user->active = 0 : $user->active = 1;
        $user->save();
        return \redirect()->route('admin.users.index');
    }
}
