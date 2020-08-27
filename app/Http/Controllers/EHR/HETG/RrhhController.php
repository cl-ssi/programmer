<?php

namespace App\Http\Controllers\EHR\HETG;

use App\EHR\HETG\Rrhh;
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
        $rrhh = Rrhh::All();
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
      $rrhh = new Rrhh($request->All());
      $rrhh->user_id = Auth::id();
      $rrhh->save();

      session()->flash('info', 'El recurso humano ha sido creado.');
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
        return view('ehr.hetg.rrhh.edit', compact('rrhh'));
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
        $rrhh->fill($request->all());
        $rrhh->user_id = Auth::id();
        $rrhh->save();

        session()->flash('info', 'El recurso humano ha sido editado.');
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
