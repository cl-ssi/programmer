<?php

namespace App\Http\Controllers\EHR\HETG;

use App\EHR\HETG\MotherActivity;
use App\EHR\HETG\ActivityType;
use App\EHR\HETG\Activity;
use App\EHR\HETG\Profession;
use App\EHR\HETG\ProfessionActivity;
use App\EHR\HETG\Specialty;
use App\EHR\HETG\SpecialityActivity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
      $activityTypes = ActivityType::orderBy('name','ASC')->get();
      $professions = Profession::orderBy('profession_name','ASC')->get();
      $specialties = Specialty::orderBy('specialty_name','ASC')->get();
      //dd($specialties);
      return view('ehr.hetg.activities.create',compact('motherActivities','activityTypes','professions','specialties'));
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
      $activity->user_id = Auth::id();
      $activity->save();



      //$activity_profession = new Activity($request->All());

      //dd($request->establishment_id);

      if($request->input('profession_id')) {
      foreach ($request->profession_id as $key => $id) {        
        $profession_activity = new ProfessionActivity();
        $profession_activity->profession_id = $id;
        $profession_activity->activity_id = $activity->id;
        $profession_activity->performance = $request->input('performance_profession_'.$id);
        $profession_activity->save();
    }
  }


    foreach ($request->specialty_id as $key => $id) {      
      $speciality_activity = new SpecialityActivity();
      $speciality_activity->speciality_id = $id;
      $speciality_activity->activity_id = $activity->id;
      $speciality_activity->performance = $request->input('performance_specialty_'.$id);
      $speciality_activity->save();
  }



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
      $activityTypes = ActivityType::orderBy('name','ASC')->get();
      return view('ehr.hetg.activities.edit', compact('activity','motherActivities','activityTypes'));
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
      $activity->user_id = Auth::id();
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
