<?php

namespace App\Http\Controllers\EHR\HETG;

use App\EHR\HETG\Specialty;
use App\EHR\HETG\SpecialtyActivity;
use App\EHR\HETG\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SpecialtyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // $specialties = Specialty::whereHas('userSpecialties', function ($query)  {
      //                                 return $query->where('user_id',Auth::id());
      //                             })->orderBy('specialty_name','ASC')->get();
      $specialties = Specialty::orderBy('specialty_name','ASC')->get();
      return view('ehr.hetg.specialties.index', compact('specialties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $activities = Activity:://where('mother_activity_id',2)
                                where('activity_type_id',1)->orderBy('activity_name','ASC')->get(); //obtiene medicas
        return view('ehr.hetg.specialties.create',compact('activities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $specialty = new Specialty($request->All());
      //$specialty->user_id = Auth::id();
      $specialty->save();

      foreach ($request->activity_id as $key => $id) {
          $specialty_activity = new SpecialtyActivity();
          $specialty_activity->specialty_id = $specialty->id;
          $specialty_activity->activity_id = $id;
          $specialty_activity->performance = $request->input('performance_activity_'.$id);
          $specialty_activity->save();
      }

      session()->flash('info', 'La especialidad ha sido creada.');
      return redirect()->route('ehr.hetg.specialties.index');
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
    public function edit(Specialty $specialty)
    {
        $activities = Activity:://where('mother_activity_id',2)
                                where('activity_type_id',1)->orderBy('activity_name','ASC')->get(); //obtiene medicas
        return view('ehr.hetg.specialties.edit', compact('specialty','activities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Specialty $specialty)
    {
      $specialty->fill($request->all());
      //$specialty->user_id = Auth::id();
      $specialty->save();

      SpecialtyActivity::where('specialty_id',$specialty->id)->delete();
      if ($request->activity_id != null) {
          foreach ($request->activity_id as $key => $id) {
              $specialty_activity = new SpecialtyActivity();
              $specialty_activity->specialty_id = $specialty->id;
              $specialty_activity->activity_id = $id;
              $specialty_activity->performance = $request->input('performance_activity_'.$id);
              $specialty_activity->save();
          }
      }

      session()->flash('info', 'La especialidad ha sido editada.');
      return redirect()->route('ehr.hetg.specialties.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Specialty $specialty)
    {
        SpecialtyActivity::where('specialty_id',$specialty->id)->delete();

        $specialty->delete();
        session()->flash('success', 'La especialidad ha sido eliminada');
        return redirect()->route('ehr.hetg.specialties.index');
    }
}
