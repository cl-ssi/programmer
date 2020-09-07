<?php

namespace App\Http\Controllers\EHR\HETG;

use App\EHR\HETG\MedicalProgramming;
use App\EHR\HETG\Rrhh;
use App\EHR\HETG\Contract;
use App\EHR\HETG\Specialty;
use App\EHR\HETG\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;

class MedicalProgrammingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programming = MedicalProgramming::All();
        return view('ehr.hetg.medical_programming.index',compact('programming'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $rrhh = Rrhh::orderBy('name','ASC')->get();
      $contracts = Contract::all();
      $specialties = Specialty::orderBy('specialty_name','ASC')->get();
      $activities = Activity::orderBy('id','ASC')->get();
      return view('ehr.hetg.medical_programming.create',compact('rrhh','contracts','specialties','activities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
      $medica_programming = new MedicalProgramming($request->All());
      $medica_programming->user_id = Auth::id();
      $medica_programming->save();

      session()->flash('info', 'La programación ha sido creada.');
      // return redirect()->route('ehr.hetg.medical_programming.index');
      return redirect()->back();
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
    public function edit(MedicalProgramming $medicalProgramming)
    {
      $rrhh = Rrhh::orderBy('name','ASC')->get();
      $contracts = Contract::all();
      $specialties = Specialty::orderBy('specialty_name','ASC')->get();
      $activities = Activity::orderBy('id','ASC')->get();
      return view('ehr.hetg.medical_programming.edit', compact('medicalProgramming','rrhh','contracts','specialties','activities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MedicalProgramming $medicalProgramming)
    {
      $medicalProgramming->fill($request->all());
      $medicalProgramming->user_id = Auth::id();
      $medicalProgramming->save();

      session()->flash('info', 'La programación ha sido editada.');
      return redirect()->route('ehr.hetg.medical_programming.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicalProgramming $medicalProgramming)
    {
      $medicalProgramming->delete();
      session()->flash('success', 'La programación ha sido eliminada');
      return redirect()->route('ehr.hetg.medical_programming.index');
    }
}
