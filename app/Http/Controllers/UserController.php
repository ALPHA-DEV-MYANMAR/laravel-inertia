<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class UserController extends Controller
{
    public function __construct()
    {
//        sleep(1);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = UserResource::collection( User::latest('id')->paginate(10));
        return Inertia::render('User/index',[
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('User/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|unique:users,email',
            'photo' => 'nullable|mimes:jpeg,png'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make('password');

        if($request->hasFile('photo')){
            $photo = $request->file('photo');
            $newName = uniqid()."_photo.".$photo->extension();
            $photo->storeAs('public/user',$newName);
            $user->photo = $newName;
        }

        $user->save();

        return redirect()->route('user.index')->with('status',$user->name.' is created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user  =  User::findOrFail($id);
        return Inertia::render('User/show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user  =  User::findOrFail($id);
        if($user->photo === null){
            $user->photo = asset('img/user.png');
        }else{
            $user->photo = asset('storage/user/'.$user->photo);
        }

        return Inertia::render('User/edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|unique:users,email,'.$id,
            'photo' => 'nullable|mimes:jpeg,png'
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make('password');

        if($request->hasFile('photo')){

            if($user->photo != null){
                Storage::delete('public/storage/user'.$user->photo);
            }

            $photo = $request->file('photo');
            $newName = uniqid()."_photo.".$photo->extension();
            $photo->storeAs('public/user',$newName);
            $user->photo = $newName;
        }

        $user->update();

        return redirect()->route('user.index')->with('status',$user->name.' is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index');
    }
}
