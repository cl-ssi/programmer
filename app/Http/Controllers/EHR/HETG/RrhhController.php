<?php

namespace App\Http\Controllers\EHR\HETG;

use App\EHR\HETG\Rrhh;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RrhhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rrhh = Rrhh::orderBy('name','ASC')->get();
        return view('ehr.hetg.rrhh.index', compact('rrhh'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ehr.hetg.rrhh.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //se crea usuario si se solicita
      if ($request->user_create) {
          if (User::where('id',$request->rut)->count() == 0) {
              $user = new User($request->All());
              $user->id = $request->rut;
              $user->name = $request->name . " " . $request->fathers_family . " " . $request->mothers_family;
              $user->password = bcrypt($request->fathers_family);;
              $user->save();
              session()->flash('info', 'El recurso humano y el usuario han sido creados.');
          }else{
              session()->flash('info', 'El recurso humano ha sido creado. Ya existe el usuario para este RRHH.');
          }
      }
      else{
          session()->flash('info', 'El recurso humano ha sido creado.');
      }

      //se crea recurso humano
      $rrhh = new Rrhh($request->All());
      $rrhh->save();

      return redirect()->route('ehr.hetg.rrhh.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pharmacies\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pharmacies\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Rrhh $rrhh)
    {
        $user = User::where('id',$rrhh->rut)->count();
        return view('ehr.hetg.rrhh.edit', compact('rrhh','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pharmacies\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rrhh $rrhh)
    {
        //se crea usuario si se solicita
        if ($request->user_edited) {
            if (User::where('id',$request->rut)->count() == 0) {
                $user = new User($request->All());
                $user->id = $request->rut;
                $user->name = $request->name . " " . $request->fathers_family . " " . $request->mothers_family;
                $user->password = bcrypt($request->fathers_family);;
                $user->save();
                session()->flash('info', 'El recurso humano ha sido editado y el usuario ha sido creado.');
            }else{
                $user = User::where('id',$request->rut)->first();
                $user->fill($request->all());
                $user->name = $request->name . " " . $request->fathers_family . " " . $request->mothers_family;
                $user->save();
                session()->flash('info', 'El recurso humano y el usuario han sido editados.');
            }
        }else{
            session()->flash('info', 'El recurso humano ha sido editado.');
        }

        //se crea rrhh
        $rrhh->fill($request->all());
        $rrhh->save();

        return redirect()->route('ehr.hetg.rrhh.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pharmacies\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rrhh $rrhh)
    {
      //se elimina la cabecera y detalles
      $rrhh->delete();
      $rrhh->save();
      session()->flash('success', 'El recurso humano ha sido eliminado');
      return redirect()->route('ehr.hetg.rrhh.index');
    }
}
