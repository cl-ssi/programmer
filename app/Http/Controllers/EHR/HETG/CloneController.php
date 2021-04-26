<?php

namespace App\Http\Controllers\EHR\HETG;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\EHR\HETG\Contract;

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
