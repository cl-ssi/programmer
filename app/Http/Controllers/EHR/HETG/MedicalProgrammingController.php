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
use Carbon\Carbon;
use App\EHR\HETG\TheoreticalProgramming;

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

    //obtiene contrato
    $contracts = Contract::where('id',$request->contract_id)->get();

    //obtiene horas teóricas
    $monday = Carbon::parse($request->date)->startOfWeek();
    $sunday = Carbon::parse($request->date)->endOfWeek();
    $theoreticalProgrammings = TheoreticalProgramming::where('year',$request->year)
                                                  ->where('rut',$request->rut)
                                                  ->where('contract_id', $request->contract_id)
                                                  ->where('specialty_id', $request->specialty_id)
                                                  ->where('profession_id', $request->profession_id)
                                                  ->whereBetween('start_date',[$monday,$sunday])
                                                  ->get();

    //se obtiene fechas de inicio y termino de cada isEventOverDiv
    $cantidad_ingresada = 0;
    foreach ($theoreticalProgrammings as $key => $theoricalProgramming) {
      $start  = new Carbon($theoricalProgramming->start_date);
      $end    = new Carbon($theoricalProgramming->end_date);
      $cantidad_ingresada += $start->diffInMinutes($end)/60;
    }
    //obtiene horas no programables
    $medical_programmings = MedicalProgramming::where('year',$request->year)
                                              ->where('rut',$request->rut)
                                              ->where('contract_id', $request->contract_id)
                                              ->where('specialty_id', $request->specialty_id)
                                              ->where('profession_id', $request->profession_id)
                                              ->get();
    foreach ($medical_programmings as $key => $medical_programming) {
       $cantidad_ingresada += $medical_programming->assigned_hour;
    }

    $cantidad_adicional = $request->assigned_hour;
    $cantidad_contrato = $contracts->first()->weekly_hours;
    if (($cantidad_ingresada + $cantidad_adicional) > $cantidad_contrato) {
        session()->flash('info', 'Excede la cantidad de horas contratadas.');
        return redirect()->back();
    }

    // dd($request->All());
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
      // return redirect()->route('ehr.hetg.medical_programming.index');
      return redirect()->back();
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
      // return redirect()->route('ehr.hetg.medical_programming.index');
      return redirect()->back();
    }
}
