<?php

namespace App\Http\Controllers\EHR\HETG;

use App\EHR\HETG\UnscheduledProgramming;
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

class UnscheduledProgrammingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programming = UnscheduledProgramming::All();
        return view('ehr.hetg.unscheduled_programming.index',compact('programming'));
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
      return view('ehr.hetg.unscheduled_programming.create',compact('rrhh','contracts','specialties','activities'));
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
    $unscheduled_programmings = UnscheduledProgramming::where('year',$request->year)
                                              ->where('rut',$request->rut)
                                              ->where('contract_id', $request->contract_id)
                                              ->where('specialty_id', $request->specialty_id)
                                              ->where('profession_id', $request->profession_id)
                                              ->get();
    foreach ($unscheduled_programmings as $key => $unscheduled_programming) {
       $cantidad_ingresada += $unscheduled_programming->assigned_hour;
    }

    $cantidad_adicional = $request->assigned_hour;
    $cantidad_contrato = $contracts->first()->weekly_hours;
    if (($cantidad_ingresada + $cantidad_adicional) > $cantidad_contrato) {
        session()->flash('info', 'Excede la cantidad de horas contratadas.');
        return redirect()->back();
    }

    // dd($request->All());
      $medica_programming = new UnscheduledProgramming($request->All());
      //$medica_programming->user_id = Auth::id();
      $medica_programming->save();

      session()->flash('info', 'La programación ha sido creada.');
      // return redirect()->route('ehr.hetg.unscheduled_programming.index');
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
    public function edit(UnscheduledProgramming $unscheduledProgramming)
    {
      $rrhh = Rrhh::orderBy('name','ASC')->get();
      $contracts = Contract::all();
      $specialties = Specialty::orderBy('specialty_name','ASC')->get();
      $activities = Activity::orderBy('id','ASC')->get();
      return view('ehr.hetg.unscheduled_programming.edit', compact('unscheduledProgramming','rrhh','contracts','specialties','activities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UnscheduledProgramming $unscheduledProgramming)
    {
      $unscheduledProgramming->fill($request->all());
      //$unscheduledProgramming->user_id = Auth::id();
      $unscheduledProgramming->save();

      session()->flash('info', 'La programación ha sido editada.');
      // return redirect()->route('ehr.hetg.unscheduled_programming.index');
      return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UnscheduledProgramming $unscheduledProgramming)
    {
      $unscheduledProgramming->delete();
      session()->flash('success', 'La programación ha sido eliminada');
      // return redirect()->route('ehr.hetg.unscheduled_programming.index');
      return redirect()->back();
    }
}
