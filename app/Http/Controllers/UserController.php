<?php

namespace App\Http\Controllers;

use App\User;
use App\EHR\HETG\Specialty;
use App\EHR\HETG\UserSpecialty;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::orderBy('name', 'asc')->get();

        if ($request) {

            $query = trim($request->get('search'));

            $users = User::where('name', 'LIKE', '%' . $query . '%')
                    ->orderBy('name', 'asc')
                    ->get();

            return view('users.index', ['users' => $users, 'search' => $query]);

        }

        return view('users.index', compact('users', 'request', 'query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::OrderBy('name')->get();
        $specialties = Specialty::OrderBy('specialty_name')->get();

        return view('users.create', compact('permissions','specialties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        //asigna permisos
        $user->syncPermissions(
            is_array($request->input('permissions')) ? $request->input('permissions') : array()
        );

        //asigna especialidades
        foreach ($request->input('specialties') as $key => $value) {
            $userSpecialty = UserSpecialty::where('specialty_id',$value)
                                          ->where('user_id', Auth::id())
                                          ->get();
            if ($userSpecialty->count() == 0) {
                $userSpecialty = new UserSpecialty();
                $userSpecialty->specialty_id = $value;
                $userSpecialty->user_id = $user->id;
                $userSpecialty->save();
            }
        }


        session()->flash('success', 'Usuario Creado Exitosamente');

        return redirect()->route('users.index');
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
        $permissions = Permission::OrderBy('name')->get();
        $specialties = Specialty::OrderBy('specialty_name')->get();

        return view('users.edit', compact('user','permissions','specialties'));
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
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        //asigna permisos
        $user->syncPermissions(
            is_array($request->input('permissions')) ? $request->input('permissions') : array()
        );

        //asigna especialidades
        foreach ($request->input('specialties') as $key => $value) {
            $userSpecialty = UserSpecialty::where('specialty_id',$value)
                                          ->where('user_id', Auth::id())
                                          ->get();
            if ($userSpecialty->count() == 0) {
                $userSpecialty = new UserSpecialty();
                $userSpecialty->specialty_id = $value;
                $userSpecialty->user_id = $user->id;
                $userSpecialty->save();
            }
        }

        session()->flash('success', 'Usuario Actualizado Exitosamente');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function showPasswordForm()
    {
        return view('users.change_password');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        if(Hash::check($request->input('current_password'), Auth()->user()->password)) {
            Auth()->user()->password = bcrypt($request->input('new_password'));
            Auth()->user()->save();
        }

        // TODO: Mostrar error si la clave antigua no coincide
        return redirect()->route('home');
    }


    /**
     * Show form for restore password.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function passwordRestore(User $user)
    {
        return view('users.restore', compact('user'));
    }

    /**
     * Set random password to user
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function passwordStore(Request $request, User $user)
    {
        if($request->input('password')) {
            $password = $request->input('password');
            $user->password = bcrypt($request->input('password'));
        }
        else {
            $password = substr(str_shuffle(MD5(microtime())), 0, 6);
            $user->password = bcrypt($password);
        }
        $user->save();

        session()->flash('info', 'Password: '. $password);
        return redirect()->back();
    }
}
