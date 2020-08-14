<?php

namespace App\Http\Controllers\EHR\HETG;

use App\EHR\HETG\Specialty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpecialtyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $specialties = Specialty::all();
      return view('ehr.hetg.specialties.index', compact('specialties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('ehr.hetg.specialties.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $specialty = new Specialty($request->All());
      $specialty->save();

      session()->flash('info', 'La especialidad ha sido creada.');
      return redirect()->route('ehr.hetg.specialties.index');
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
    public function edit(Specialty $specialty)
    {
        return view('ehr.hetg.specialties.edit', compact('specialty'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Specialty $specialty)
    {
      $specialty->fill($request->all());
      $specialty->save();

      session()->flash('info', 'La especialidad ha sido editada.');
      return redirect()->route('ehr.hetg.specialties.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Specialty $specialty)
    {
      $specialty->delete();
      session()->flash('success', 'La especialidad ha sido eliminada');
      return redirect()->route('ehr.hetg.specialties.index');
    }
}
