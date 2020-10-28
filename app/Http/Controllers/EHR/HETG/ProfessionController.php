<?php

namespace App\Http\Controllers\EHR\HETG;

use App\EHR\HETG\Profession;
use App\EHR\HETG\ProfessionActivity;
use App\EHR\HETG\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $professions = Profession::whereHas('userProfessions', function ($query)  {
                                        return $query->where('user_id',Auth::id());
                                    })->orderBy('profession_name','ASC')->get();
        // $professions = Profession::>orderBy('profession_name','ASC')->get();
        return view('ehr.hetg.professions.index', compact('professions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $activities = Activity:://where('mother_activity_id',2)
                                where('activity_type_id',2)->orderBy('activity_name','ASC')->get(); //obtiene NO medicas
        return view('ehr.hetg.professions.create',compact('activities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $profession = new Profession($request->All());
      //$profession->user_id = Auth::id();
      $profession->save();

      foreach ($request->activity_id as $key => $id) {
          $profession_activity = new ProfessionActivity();
          $profession_activity->profession_id = $profession->id;
          $profession_activity->activity_id = $id;
          $profession_activity->performance = $request->input('performance_activity_'.$id);
          $profession_activity->save();
      }

      session()->flash('info', 'La profesión ha sido creada.');
      return redirect()->route('ehr.hetg.professions.index');
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
    public function edit(Profession $profession)
    {
        $activities = Activity:://where('mother_activity_id',2)
                                where('activity_type_id',2)->orderBy('activity_name','ASC')->get(); //obtiene NO medicas
        return view('ehr.hetg.professions.edit', compact('profession','activities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profession $profession)
    {
      $profession->fill($request->all());
      //$profession->user_id = Auth::id();
      $profession->save();

      ProfessionActivity::where('profession_id',$profession->id)->delete();
      if ($request->activity_id != null) {
          foreach ($request->activity_id as $key => $id) {
              $profession_activity = new ProfessionActivity();
              $profession_activity->profession_id = $profession->id;
              $profession_activity->activity_id = $id;
              $profession_activity->performance = $request->input('performance_activity_'.$id);
              $profession_activity->save();
          }
      }

      session()->flash('info', 'La profesión ha sido editada.');
      return redirect()->route('ehr.hetg.professions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profession $profession)
    {
        ProfessionActivity::where('profession_id',$profession->id)->delete();

        $profession->delete();
        session()->flash('success', 'La profesión ha sido eliminada');
        return redirect()->route('ehr.hetg.professions.index');
    }
}
