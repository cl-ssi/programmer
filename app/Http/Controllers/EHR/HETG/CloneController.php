<?php

namespace App\Http\Controllers\EHR\HETG;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\EHR\HETG\Contract;
use App\EHR\HETG\TheoreticalProgramming;
use Carbon\Carbon;

class CloneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ehr.hetg.management.clone');
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // contratos
        $contracts = Contract::where('year',$request->source_year)->get();
        foreach ($contracts as $key => $contract) {
          $new_contract = new Contract();
          $new_contract->rut = $contract->rut;
          $new_contract->year = $request->destination_year;
          $new_contract->law = $contract->law;
          $new_contract->contract_id = $contract->contract_id;
          $new_contract->weekly_hours = $contract->weekly_hours;
          $new_contract->shift_system = $contract->shift_system;
          $new_contract->obs = $contract->obs;
          $new_contract->legal_holidays = $contract->legal_holidays;
          $new_contract->compensatory_rest = $contract->compensatory_rest;
          $new_contract->administrative_permit = $contract->administrative_permit;
          $new_contract->training_days = $contract->training_days;
          $new_contract->breastfeeding_time = $contract->breastfeeding_time;
          $new_contract->weekly_collation = $contract->weekly_collation;
          $new_contract->contract_start_date = $contract->contract_start_date;
          $new_contract->contract_end_date = $contract->contract_end_date;
          $new_contract->unit = $contract->unit;
          $new_contract->unit_code = $contract->unit_code;
          $new_contract->service_id = $contract->service_id;
          $new_contract->save();
        }

        set_time_limit(3600);
        ini_set('memory_limit', '1024M');

        $date = Carbon::parse($request->source_year.'-12-31');
        for ($i=1; $i <= 7 ; $i++) {
          //no se considera última semana, porque puede que no esté llena entera con información (cuando el año termina a mitad de semana)
          $date->subDays(7);
          $weekStartDate = $date->startOfWeek()->format('Y-m-d H:i');
          $weekEndDate = $date->endOfWeek()->format('Y-m-d H:i');
          print_r("<br> ********************" . $weekStartDate . " " . $weekEndDate . "<br><br>");

          $theoreticalProgrammings = TheoreticalProgramming::whereBetween('start_date',[$weekStartDate,$weekEndDate])
                                                           ->whereHas('contract')
                                                           ->orderBy('id','ASC')->get();
          foreach ($theoreticalProgrammings as $key => $theoreticalProgramming) {

            // dd($theoreticalProgramming->contract_id, Contract::find($theoreticalProgramming->contract_id));
            $old_contract = Contract::find($theoreticalProgramming->contract_id);
            $new_contract = Contract::where('year',$request->destination_year)
                                    ->where('rut',$old_contract->rut)
                                    ->where('law',$old_contract->law)
                                    ->where('weekly_hours',$old_contract->weekly_hours)
                                    ->first();

            $new_start_date = Carbon::parse($theoreticalProgramming->start_date)->addWeeks(7);
            $new_end_date = Carbon::parse($theoreticalProgramming->end_date)->addWeeks(7);
            // print_r($theoreticalProgramming->id ." " .$new_start_date . " " . $new_end_date ."<br>");
            while ($new_end_date->format('Y') != ($request->destination_year + 1)) {
              print_r($theoreticalProgramming->id ." " .$new_start_date . " " . $new_end_date ."<br>");
              $NewTheoreticalProgramming = new TheoreticalProgramming();
              $NewTheoreticalProgramming->contract_id = $new_contract->id;
              $NewTheoreticalProgramming->rut = $theoreticalProgramming->rut;
              $NewTheoreticalProgramming->specialty_id = $theoreticalProgramming->specialty_id;
              $NewTheoreticalProgramming->activity_id = $theoreticalProgramming->activity_id;
              $NewTheoreticalProgramming->profession_id = $theoreticalProgramming->profession_id;
              $NewTheoreticalProgramming->start_date = $new_start_date;
              $NewTheoreticalProgramming->end_date = $new_end_date;
              $NewTheoreticalProgramming->performance = $theoreticalProgramming->performance;
              $NewTheoreticalProgramming->year = $request->destination_year;
              $NewTheoreticalProgramming->contract_day_type = $theoreticalProgramming->contract_day_type;
              $NewTheoreticalProgramming->save();

              $new_start_date = $new_start_date->addWeeks(7);
              $new_end_date = $new_end_date->addWeeks(7);
            }
          }
        }

        dd($weekStartDate);

        session()->flash('info', 'Se han clonado ' . $key . ' filas.');
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
}
