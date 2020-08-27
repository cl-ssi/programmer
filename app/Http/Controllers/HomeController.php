<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        return view('home');
        // // 'name', 'email', 'password',
        // $user = new User();
        // $user->id = 1;
        // // $user->yani_id = "E17430005-4";
        // // $user->name = "asd";//$request->name;
        // // $user->email = 'sick@sick.cl';
        // // $user->password = bcrypt($user->id);
        // // $user->profile = 'Administrador';
        // // $user->save();
        // session(['yani_id' => $request->yani_id, 'name' => $request->name, 'profile' => $request->profile]);
        //
        // Auth::login($user);
        // return view('home');
    }
}
