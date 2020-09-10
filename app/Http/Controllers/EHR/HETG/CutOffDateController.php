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
        $array_programacion_medica = null;
        $array_programacion_no_medica = null;
        $cutoffdates = CutOffDate::all();
        return view('ehr.hetg.cutoffdates.index', compact('cutoffdates','array_programacion_medica', 'array_programacion_no_medica'));
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
        //obtiene datos programables del período
        $theoreticalProgrammings = TheoreticalProgramming::whereBetween('start_date',[$monday,$sunday])
                                                        ->whereNull('contract_day_type')
                                                        ->get();

        $date = new Carbon($cutoffdate->date);
        //obtiene datos NO programables del año
        $medicalProgrammings = MedicalProgramming::where('year',$date->get('year'))->get();

        //se obtiene fechas de inicio y termino de cada isEventOverDiv
        foreach ($theoreticalProgrammings as $key => $theoricalProgramming) {
          $start  = new Carbon($theoricalProgramming->start_date);
          $end    = new Carbon($theoricalProgramming->end_date);
          $theoricalProgramming->duration_theorical_programming = $start->diffInMinutes($end)/60;
        }



        //programables - PROGRAMACION MÉDICA
        $array_programacion_medica = array();
        foreach ($theoreticalProgrammings->whereNotNull('specialty_id') as $key => $theoricalProgramming) {
            $array_programacion_medica[$theoricalProgramming->rut][$theoricalProgramming->contract->contract_id]
                                      [$theoricalProgramming->specialty->id_specialty . ' - ' . $theoricalProgramming->specialty->specialty_name]
                                      [$theoricalProgramming->activity->id_activity . ' - ' . $theoricalProgramming->activity->activity_name]['assigned_hour'] = 0;
            $array_programacion_medica[$theoricalProgramming->rut][$theoricalProgramming->contract->contract_id]
                                      [$theoricalProgramming->specialty->id_specialty . ' - ' . $theoricalProgramming->specialty->specialty_name]
                                      [$theoricalProgramming->activity->id_activity . ' - ' . $theoricalProgramming->activity->activity_name]['rdto_hour'] = 0;
        }
        foreach ($theoreticalProgrammings->whereNotNull('specialty_id') as $key => $theoricalProgramming) {
            $array_programacion_medica[$theoricalProgramming->rut][$theoricalProgramming->contract->contract_id]
                                      [$theoricalProgramming->specialty->id_specialty . ' - ' . $theoricalProgramming->specialty->specialty_name]
                                      [$theoricalProgramming->activity->id_activity . ' - ' . $theoricalProgramming->activity->activity_name]['assigned_hour'] += $theoricalProgramming->duration_theorical_programming;
            $array_programacion_medica[$theoricalProgramming->rut][$theoricalProgramming->contract->contract_id]
                                      [$theoricalProgramming->specialty->id_specialty . ' - ' . $theoricalProgramming->specialty->specialty_name]
                                      [$theoricalProgramming->activity->id_activity . ' - ' . $theoricalProgramming->activity->activity_name]['rdto_hour'] = $theoricalProgramming->specialty->activities->where('id',$theoricalProgramming->activity->id)->first()->pivot->performance;
        }
        //NO programables - PROGRAMACION MÉDICA
        foreach ($medicalProgrammings->whereNotNull('specialty_id') as $key => $medicalProgramming) {
            $array_programacion_medica[$medicalProgramming->rut][$medicalProgramming->contract->contract_id]
                                      [$medicalProgramming->specialty->id_specialty . ' - ' . $medicalProgramming->specialty->specialty_name]
                                      [$medicalProgramming->activity->id_activity . ' - ' . $medicalProgramming->activity->activity_name]['assigned_hour'] = 0;
            $array_programacion_medica[$medicalProgramming->rut][$medicalProgramming->contract->contract_id]
                                      [$medicalProgramming->specialty->id_specialty . ' - ' . $medicalProgramming->specialty->specialty_name]
                                      [$medicalProgramming->activity->id_activity . ' - ' . $medicalProgramming->activity->activity_name]['rdto_hour'] = 0;
        }
        foreach ($medicalProgrammings->whereNotNull('specialty_id') as $key => $medicalProgramming) {
            $array_programacion_medica[$medicalProgramming->rut][$medicalProgramming->contract->contract_id]
                                      [$medicalProgramming->specialty->id_specialty . ' - ' . $medicalProgramming->specialty->specialty_name]
                                      [$medicalProgramming->activity->id_activity . ' - ' . $medicalProgramming->activity->activity_name]['assigned_hour'] += $medicalProgramming->assigned_hour;
            $array_programacion_medica[$medicalProgramming->rut][$medicalProgramming->contract->contract_id]
                                      [$medicalProgramming->specialty->id_specialty . ' - ' . $medicalProgramming->specialty->specialty_name]
                                      [$medicalProgramming->activity->id_activity . ' - ' . $medicalProgramming->activity->activity_name]['rdto_hour'] = $medicalProgramming->specialty->activities->where('id',$medicalProgramming->activity->id)->first()->pivot->performance;
        }






        //programables - PROGRAMACION NO MÉDICA
        $array_programacion_no_medica = array();
        foreach ($theoreticalProgrammings->whereNotNull('profession_id') as $key => $theoricalProgramming) {
            $array_programacion_no_medica[$theoricalProgramming->rut][$theoricalProgramming->contract->contract_id]
                                      [$theoricalProgramming->profession->id_profession . ' - ' . $theoricalProgramming->profession->profession_name]
                                      [$theoricalProgramming->activity->id_activity . ' - ' . $theoricalProgramming->activity->activity_name]['assigned_hour'] = 0;
            $array_programacion_no_medica[$theoricalProgramming->rut][$theoricalProgramming->contract->contract_id]
                                      [$theoricalProgramming->profession->id_profession . ' - ' . $theoricalProgramming->profession->profession_name]
                                      [$theoricalProgramming->activity->id_activity . ' - ' . $theoricalProgramming->activity->activity_name]['rdto_hour'] = 0;
        }
        foreach ($theoreticalProgrammings->whereNotNull('profession_id') as $key => $theoricalProgramming) {
            $array_programacion_no_medica[$theoricalProgramming->rut][$theoricalProgramming->contract->contract_id]
                                      [$theoricalProgramming->profession->id_profession . ' - ' . $theoricalProgramming->profession->profession_name]
                                      [$theoricalProgramming->activity->id_activity . ' - ' . $theoricalProgramming->activity->activity_name]['assigned_hour'] += $theoricalProgramming->duration_theorical_programming;
            $array_programacion_no_medica[$theoricalProgramming->rut][$theoricalProgramming->contract->contract_id]
                                      [$theoricalProgramming->profession->id_profession . ' - ' . $theoricalProgramming->profession->profession_name]
                                      [$theoricalProgramming->activity->id_activity . ' - ' . $theoricalProgramming->activity->activity_name]['rdto_hour'] = $theoricalProgramming->profession->activities->where('id',$theoricalProgramming->activity->id)->first()->pivot->performance;
        }
        //NO programables - PROGRAMACION NO MÉDICA
        foreach ($medicalProgrammings->whereNotNull('profession_id') as $key => $medicalProgramming) {
            $array_programacion_no_medica[$medicalProgramming->rut][$medicalProgramming->contract->contract_id]
                                      [$medicalProgramming->profession->id_profession . ' - ' . $medicalProgramming->profession->profession_name]
                                      [$medicalProgramming->activity->id_activity . ' - ' . $medicalProgramming->activity->activity_name]['assigned_hour'] = 0;
            $array_programacion_no_medica[$medicalProgramming->rut][$medicalProgramming->contract->contract_id]
                                      [$medicalProgramming->profession->id_profession . ' - ' . $medicalProgramming->profession->profession_name]
                                      [$medicalProgramming->activity->id_activity . ' - ' . $medicalProgramming->activity->activity_name]['rdto_hour'] = 0;
        }
        foreach ($medicalProgrammings->whereNotNull('profession_id') as $key => $medicalProgramming) {
            $array_programacion_no_medica[$medicalProgramming->rut][$medicalProgramming->contract->contract_id]
                                      [$medicalProgramming->profession->id_profession . ' - ' . $medicalProgramming->profession->profession_name]
                                      [$medicalProgramming->activity->id_activity . ' - ' . $medicalProgramming->activity->activity_name]['assigned_hour'] += $medicalProgramming->assigned_hour;
            $array_programacion_no_medica[$medicalProgramming->rut][$medicalProgramming->contract->contract_id]
                                      [$medicalProgramming->profession->id_profession . ' - ' . $medicalProgramming->profession->profession_name]
                                      [$medicalProgramming->activity->id_activity . ' - ' . $medicalProgramming->activity->activity_name]['rdto_hour'] = $medicalProgramming->profession->activities->where('id',$medicalProgramming->activity->id)->first()->pivot->performance;
        }

        // dd($array_programacion_no_medica);

        $cutoffdates = CutOffDate::all();
        return view('ehr.hetg.cutoffdates.index', compact('cutoffdates','array_programacion_medica', 'array_programacion_no_medica'));
        // return redirect()->route('ehr.hetg.cutoffdates.index')->compact('array');
    }
}
