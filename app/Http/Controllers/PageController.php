<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    public function index(){
        $users = User::all()->each(function ($user){
            $user->showTime = $user->created_at->format('d M Y');
            if($user->photo === null){
                $user->photo = asset('img/user.png');
            }
        });
        return Inertia::render('index',[
            'users' => $users
        ]);
    }

    public function destory($id){
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('index');
    }
}
