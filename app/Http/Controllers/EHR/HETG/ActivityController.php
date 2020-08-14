<?php

namespace App\Http\Controllers\EHR\HETG;

use App\EHR\HETG\MotherActivity;
use App\EHR\HETG\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $activities = Activity::all();
      return view('ehr.hetg.activities.index', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $motherActivities = MotherActivity::orderBy('description','ASC')->get();
      return view('ehr.hetg.activities.create',compact('motherActivities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $activity = new Activity($request->All());
      $activity->save();

      session()->flash('info', 'La actividad ha sido creada.');
      return redirect()->route('ehr.hetg.activities.index');
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
    public function edit(Activity $activity)
    {
      $motherActivities = MotherActivity::orderBy('description','ASC')->get();
      return view('ehr.hetg.activities.edit', compact('activity','motherActivities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
      $activity->fill($request->all());
      $activity->save();

      session()->flash('info', 'La actividad ha sido editada.');
      return redirect()->route('ehr.hetg.activities.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
      $activity->delete();
      session()->flash('success', 'La actividad ha sido eliminada');
      return redirect()->route('ehr.hetg.activities.index');
    }
}
