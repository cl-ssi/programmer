<?php

namespace App\Http\Controllers;

use App\User;
use App\EHR\HETG\Specialty;
use App\EHR\HETG\Profession;
use App\EHR\HETG\OperatingRoom;
use App\EHR\HETG\UserSpecialty;
use App\EHR\HETG\UserProfession;
use App\EHR\HETG\UserOperatingRoom;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Http\Requests\updatePassword;

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
        // dd($users->first()->specialties);

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
        $roles = Role::OrderBy('name')->get();
        $specialties = Specialty::OrderBy('specialty_name')->get();
        $professions = Profession::OrderBy('profession_name')->get();
        $operating_rooms = OperatingRoom::OrderBy('id')->where('description','LIKE', 'Box%')->get();
        return view('users.create', compact('permissions','roles','specialties','professions','operating_rooms'));
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
        $user->id = $request->input('id');
        $user->dv = $request->input('dv');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        //asigna permisos
        $user->syncRoles(
            is_array($request->input('roles')) ? $request->input('roles') : array()
        );

        $user->syncPermissions(
            is_array($request->input('permissions')) ? $request->input('permissions') : array()
        );

        //asigna especialidades
        if ($request->input('specialties')!=null) {
            foreach ($request->input('specialties') as $key => $value) {
                $userSpecialty = UserSpecialty::where('specialty_id',$value)
                                              ->where('user_id', $user->id)
                                              ->get();
                if ($userSpecialty->count() == 0) {
                    $userSpecialty = new UserSpecialty();
                    $userSpecialty->specialty_id = $value;
                    $userSpecialty->user_id = $user->id;
                    $userSpecialty->save();
                }
            }
        }


        //asigna profesiones
        if ($request->input('professions')!=null) {
            foreach ($request->input('professions') as $key => $value) {
                $userProfession = UserProfession::where('profession_id',$value)
                                                ->where('user_id', $user->id)
                                                ->get();
                if ($userProfession->count() == 0) {
                    $userProfession = new UserProfession();
                    $userProfession->profession_id = $value;
                    $userProfession->user_id = $user->id;
                    $userProfession->save();
                }
            }
        }


        //asigna pabellones
        if ($request->input('operating_rooms')!=null) {
            foreach ($request->input('operating_rooms') as $key => $value) {
                $userOperatingRoom = UserOperatingRoom::where('operating_room_id',$value)
                                                ->where('user_id', $user->id)
                                                ->get();
                if ($userOperatingRoom->count() == 0) {
                    $userOperatingRoom = new UserOperatingRoom();
                    $userOperatingRoom->operating_room_id = $value;
                    $userOperatingRoom->user_id = $user->id;
                    $userOperatingRoom->save();
                }
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
        $roles = Role::OrderBy('name')->get();
        $specialties = Specialty::OrderBy('specialty_name')->get();
        $professions = Profession::OrderBy('profession_name')->get();
        $operating_rooms = OperatingRoom::OrderBy('id')->where('description','LIKE', 'Box%')->get();
        return view('users.edit', compact('user','permissions','roles','specialties','professions','operating_rooms'));
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
        $user->syncRoles(
            is_array($request->input('roles')) ? $request->input('roles') : array()
        );

        $user->syncPermissions(
            is_array($request->input('permissions')) ? $request->input('permissions') : array()
        );

        //asigna especialidades
        if($request->input('specialties')!=null){

            //elimina lo no seleccionado
            $userSpecialties = UserSpecialty::where('user_id', $user->id)->whereNotIn('specialty_id',$request->input('specialties'))->delete();

            //agrega las nuevas especialidades
            foreach ($request->input('specialties') as $key => $value) {
                $userSpecialty = UserSpecialty::where('specialty_id',$value)
                                              ->where('user_id', $user->id)
                                              ->get();
                if ($userSpecialty->count() == 0) {
                    $userSpecialty = new UserSpecialty();
                    $userSpecialty->specialty_id = $value;
                    $userSpecialty->user_id = $user->id;
                    $userSpecialty->save();
                }
            }
        }

        //asigna profesiones
        if($request->input('professions')!=null){

            //elimina lo no seleccionado
            $UserProfessions = UserProfession::where('user_id', $user->id)->whereNotIn('profession_id',$request->input('professions'))->delete();

            //agrega las nuevas profesiones
            foreach ($request->input('professions') as $key => $value) {
                $userProfession = UserProfession::where('profession_id',$value)
                                                ->where('user_id', $user->id)
                                                ->get();
                if ($userProfession->count() == 0) {
                    $userProfession = new UserProfession();
                    $userProfession->profession_id = $value;
                    $userProfession->user_id = $user->id;
                    $userProfession->save();
                }
            }
        }


        //asigna pabellones
        if($request->input('operating_rooms')!=null){
            foreach ($request->input('operating_rooms') as $key => $value) {
                $userOperatingRoom = UserOperatingRoom::where('operating_room_id',$value)
                                                      ->where('user_id', $user->id)
                                                     ->get();
                if ($userOperatingRoom->count() == 0) {
                    $userOperatingRoom = new UserOperatingRoom();
                    $userOperatingRoom->operating_room_id = $value;
                    $userOperatingRoom->user_id = $user->id;
                    $userOperatingRoom->save();
                }
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

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\User  $user
    //  * @return \Illuminate\Http\Response
    //  */
    // public function updatePassword(Request $request)
    // {
    //     if(Hash::check($request->input('current_password'), Auth()->user()->password)) {
    //         Auth()->user()->password = bcrypt($request->input('new_password'));
    //         Auth()->user()->save();
    //     }
    //
    //     // TODO: Mostrar error si la clave antigua no coincide
    //     return redirect()->route('home');
    // }

    /**
     * Show the form for change password.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function editPassword() {
        return view('users.edit_password');
    }

    /**
     * Update the current loged user password
     *
     * @param  \Illuminate\Http\updatePassword  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(updatePassword $request) {
        if(Hash::check($request->password, Auth()->user()->password)) {
            Auth()->user()->password = bcrypt($request->newpassword);
            Auth()->user()->save();

            session()->flash('success', 'Su clave ha sido cambiada con éxito.');

            // if( Auth()->user()->hasPermissionTo('Users: must change password') ) {
            //     Auth()->user()->revokePermissionTo('Users: must change password');
            //     Auth::login(Auth()->user());
            // }

        }
        else {
            session()->flash('danger', 'La clave actual es erronea.');
        }

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
