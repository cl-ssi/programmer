<?php

namespace App\Http\Controllers\EHR\HETG;

use App\EHR\HETG\MedicalProgramming;
use App\EHR\HETG\TheoreticalProgramming;
use App\EHR\HETG\CutOffDate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CutOffDateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $array = null;
        $cutoffdates = CutOffDate::all();
        return view('ehr.hetg.cutoffdates.index', compact('cutoffdates','array'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      // $cutoffdates = CutOffDate::orderBy('date','ASC')->get();
      return view('ehr.hetg.cutoffdates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $cutOffDate = new CutOffDate($request->All());
      $cutOffDate->user_id = Auth::id();
      $cutOffDate->save();

      session()->flash('info', 'La fecha de corte ha sido creada.');
      return redirect()->route('ehr.hetg.cutoffdates.index');
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
    public function edit(CutOffDate $cutoffdate)
    {
      return view('ehr.hetg.cutoffdates.edit', compact('cutoffdate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CutOffDate $cutoffdate)
    {
      $cutoffdate->fill($request->all());
      $cutoffdate->user_id = Auth::id();
      $cutoffdate->save();

      session()->flash('info', 'La fecha de corte ha sido editada.');
      return redirect()->route('ehr.hetg.cutoffdates.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CutOffDate $cutoffdate)
    {
      $cutoffdate->delete();
      session()->flash('success', 'La fecha de corte ha sido eliminada');
      return redirect()->route('ehr.hetg.cutoffdates.index');
    }

    public function consolidated_programming(CutOffDate $cutoffdate)
    {
        //obtiene comienzo y termino del periodo
        $monday = Carbon::parse($cutoffdate->date)->startOfWeek();
        $sunday = Carbon::parse($cutoffdate->date)->endOfWeek();
        //obtiene datos del periodo
        $theoreticalProgrammings = TheoreticalProgramming::whereBetween('start_date',[$monday,$sunday])
                                                        ->whereNull('contract_day_type')
                                                        ->get();
        //se obtiene fechas de inicio y termino de cada isEventOverDiv
        foreach ($theoreticalProgrammings as $key => $theoricalProgramming) {
          $start  = new Carbon($theoricalProgramming->start_date);
          $end    = new Carbon($theoricalProgramming->end_date);
          $theoricalProgramming->duration_theorical_programming = $start->diffInMinutes($end)/60;
        }
        //agrupación
        $array = array();
        foreach ($theoreticalProgrammings as $key => $theoricalProgramming) {
          $array[$theoricalProgramming->rut][$theoricalProgramming->contract->contract_id]
                [$theoricalProgramming->specialty->id_specialty . ' - ' . $theoricalProgramming->specialty->specialty_name]
                [$theoricalProgramming->activity->id_activity . ' - ' . $theoricalProgramming->activity->activity_name] = 0;
        }
        //obtiene info.
        foreach ($theoreticalProgrammings as $key => $theoricalProgramming) {
          $array[$theoricalProgramming->rut][$theoricalProgramming->contract->contract_id]
                [$theoricalProgramming->specialty->id_specialty . ' - ' . $theoricalProgramming->specialty->specialty_name]
                [$theoricalProgramming->activity->id_activity . ' - ' . $theoricalProgramming->activity->activity_name] += $theoricalProgramming->duration_theorical_programming;
        }

        // dd($array);
        $cutoffdates = CutOffDate::all();
        return view('ehr.hetg.cutoffdates.index', compact('cutoffdates','array'));
        // return redirect()->route('ehr.hetg.cutoffdates.index')->compact('array');
    }
}
