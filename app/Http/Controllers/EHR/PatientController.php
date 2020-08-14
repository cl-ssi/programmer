<?php

namespace App\Http\Controllers\EHR;

use App\EHR\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchParam = $request->get('id');
        $patients = Patient::Search($request->get('id'))->orderBy('name')->paginate(10);
        return view('ehr.patient.index', compact('patients', 'searchParam'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ehr.patient.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $patient = new Patient($request->All());
        $patient->save();
        session()->flash('info', 'El usuario '.$patient->name.' ha sido creado.');
        return redirect()->route('ehr.patient.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EHR\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        /* Set current patient active for all process */
        session(['patient' => $patient]);

        return view('ehr.patient.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EHR\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        return view('ehr.patient.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EHR\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        $patient->fill($request->all());
        $patient->save();

        return redirect()->route('ehr.patient.show', $patient->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EHR\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EHR\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function forget()
    {
        /* Set current patient active for all process */
        session()->forget(['patient']);
        return redirect()->back();
    }
}
