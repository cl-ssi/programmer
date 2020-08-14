<?php

namespace App\Http\Controllers\EHR\HETG;

use App\EHR\HETG\MotherActivity;
use App\EHR\HETG\Activity;
use App\EHR\HETG\CalendarProgramming;
use App\EHR\HETG\Rrhh;
use App\EHR\HETG\Contract;
use App\EHR\HETG\MedicalProgramming;
use App\EHR\HETG\TheoreticalProgramming;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class TheoreticalProgrammingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if ($request->get('year')) {
        $year = $request->get('year');
        $rut = $request->get('rut');
      }
      else{
        $date = Carbon::now();
        $year = $date->format('Y');
        $rut = 0;
      }

      $motherActivities = MotherActivity::where('id',2)->get();
      $ids_actividades = $motherActivities->first()->activities->pluck('id')->toArray(); //se obtienen actividades de pabellón teórico
      $theoricalProgrammings = TheoreticalProgramming::where('year',$year)
                                                    ->where('rut',$rut)->get();

      //se obtiene fechas de inicio y termino de cada isEventOverDiv
      foreach ($theoricalProgrammings as $key => $theoricalProgramming) {
        $week_day = $theoricalProgramming->week_day;
        if ($theoricalProgramming->week_day == 0) {
          $week_day = 7;
        }
        $theoricalProgramming->start_date = "1900-01-0". $week_day . " " . $theoricalProgramming->start_time;
        $theoricalProgramming->end_date = "1900-01-0". $week_day . " " . $theoricalProgramming->end_time;

        $start  = new Carbon($theoricalProgramming->start_date);
        $end    = new Carbon($theoricalProgramming->end_date);
        $theoricalProgramming->duration_theorical_programming = $start->diffInMinutes($end)/60;
      }

      //obtiene información de programas médicos asignados
      $medicalProgrammings = MedicalProgramming::where('year',$year)
                                              ->where('rut',$rut)
                                              ->whereIn('activity_id',$ids_actividades)
                                              ->get();
      $array = array();
      foreach ($medicalProgrammings as $key => $medicalProgramming) {
        $array[$medicalProgramming->contract->first()->law] = $medicalProgrammings;
      }

      // $rrhhs = Rrhh::whereHas('contracts', function ($query) use ($year) {
      //                return $query->where('year',$year);
      //             })->orderby('name','ASC')->get();

      $rrhhs = Rrhh::whereHas('contracts', function ($query) use ($year) {
                     return $query;//->where('year',$year);
                  })->orderby('name','ASC')->get();

        //información para días contrato
        $contracts = Contract::where('rut',$rut)->get();
        // $rut = NULL;
        // if ($contracts) {
        //     $rut = $contracts->first()->rut;
        // }
        // dd($rut);

        $contract_days = CalendarProgramming::where('rut',$rut)->whereNotNull('contract_day_type')->get();
        // dd($contract_days);

      return view('ehr.hetg.management.theoretical_programmer',compact('request','rrhhs','array','theoricalProgrammings','contracts','rut','contract_days'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage: se usa para guardar dias de contrato (feriados, etc.)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // ### Validaciones ###

        //### Validación 1: que no se topen los dias con ya registrados
        $count1 = CalendarProgramming::where('rut',$request->rut)
                                     ->whereNotNull('contract_day_type')
                                     ->whereRaw('? between start_date and end_date', [$request->start_date])
                                     ->count();
        $count2 = CalendarProgramming::where('rut',$request->rut)
                                     ->whereRaw('? between start_date and end_date', [$request->end_date])
                                     ->count();
        if (($count1 + $count2) != 0) {
            session()->flash('danger', 'Ya existe días administrativos registrados en esas fechas.');
            return redirect()->back();
        }


        //### Validacion 2: que no excedan los dias de los contratos -

        //obtiene días que se registrarán (request)
        $start  = new Carbon($request->start_date);
        $end    = new Carbon($request->end_date);
        $register_days = $start->diffInDays($end)+1;

        //se obtienen los permisos de contrato ya candelarizados
        $contract_days = CalendarProgramming::where('rut',$request->rut)
                                            ->whereNotNull('contract_day_type')
                                            ->whereYear('start_date', $request->year)
                                            ->get();
        $matrix = [];
        foreach ($contract_days as $key => $contract_day) {
            $matrix[$contract_day->contract_day_type]['cantidad'] = 0;
        }

        //cantidad de días calendarizados por cada tipo de permiso
        foreach ($contract_days as $key => $contract_day) {
            $start  = new Carbon($contract_day->start_date);
            $end    = new Carbon($contract_day->end_date);
            $matrix[$contract_day->contract_day_type]['cantidad'] += floor($start->diffInDays($end)) + 1;
        }

        //se suma cantidad que viene en el request, para asi validar abajo si se peude ingresar o no
        foreach ($matrix as $key => $dd) {
            if ($key == $request->contract_day_type) {
                $matrix[$key]['cantidad'] += $register_days;
            }
        }

        //se valida si las cantidades están dentro del margen de los contratado

        //se obtiene infor de contratos
        $contract_matrix['legal_holidays'] = 0;
        $contract_matrix['compensatory_rest'] = 0;
        $contract_matrix['administrative_permit'] = 0;
        $contract_matrix['training_days'] = 0;

        $contracts = Contract::where('rut',$request->rut)
                             ->where('year',$request->year)
                             ->get();
        foreach ($contracts as $key => $contract) {
            $contract_matrix['legal_holidays'] += $contract->legal_holidays;
            $contract_matrix['compensatory_rest'] += $contract->compensatory_rest;
            $contract_matrix['administrative_permit'] += $contract->administrative_permit;
            $contract_matrix['training_days'] += $contract->training_days;
        }

        //se verifica si exceden cantidades según sumatoria de contratos
        foreach ($matrix as $key => $value) {
            if($key == "legal_holidays"){
                if ($value['cantidad'] > $contract_matrix['legal_holidays']) {
                    session()->flash('danger', 'Se superó la cantidad de feriados legales.');
                    return redirect()->back();
                }
            }
            if($key == "compensatory_rest"){
                if ($value['cantidad'] > $contract_matrix['compensatory_rest']) {
                    session()->flash('danger', 'Se superó la cantidad de días descanzo compensatorio.');
                    return redirect()->back();
                }
            }
            if($key == "administrative_permit"){
                if ($value['cantidad'] > $contract_matrix['administrative_permit']) {
                    session()->flash('danger', 'Se superó la cantidad de días de permiso administrativos.');
                    return redirect()->back();
                }
            }
            if($key == "training_days"){
                if ($value['cantidad'] > $contract_matrix['training_days']) {
                    session()->flash('danger', 'Se superó la cantidad de días de congreso o capacitación.');
                    return redirect()->back();
                }
            }
        }




        //### Se ingresa información del evento
        $calendarProgramming = new CalendarProgramming($request->all());
        $calendarProgramming->end_date = $request->end_date . " 23:59:59";
        $calendarProgramming->user_id = session('yani_id');//Auth::user()->yani_id;//id;
        $calendarProgramming->save();

        session()->flash('info', 'El evento ha sido creado.');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function saveMyEvent(Request $request){
      $theoreticalProgramming = new TheoreticalProgramming($request->all());
      $theoreticalProgramming->user_id = session('yani_id');//Auth::user()->yani_id;//id;
      $theoreticalProgramming->save();
    }

    //elimina el dato - queda respaldo de la eliminación
    public function deleteMyEvent(Request $request){
      $theoreticalProgramming = TheoreticalProgramming::where('rut',$request->rut)
                                                      ->where('activity_id',$request->activity_id)
                                                      ->where('week_day',$request->week_day)
                                                      ->where('start_time',$request->start_time)
                                                      ->where('end_time',$request->end_time);
      $theoreticalProgramming->delete(); //forceDelete
    }

    //elimina el dato (cuando son movimientos en el calendario) - no queda respaldo
    public function deleteMyEventForce(Request $request){
      $theoreticalProgramming = TheoreticalProgramming::where('rut',$request->rut)
                                                      ->where('activity_id',$request->activity_id)
                                                      ->where('week_day',$request->week_day)
                                                      ->where('start_time',$request->start_time)
                                                      ->where('end_time',$request->end_time);
      $theoreticalProgramming->forceDelete();
    }
}
