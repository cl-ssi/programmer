<?php

namespace App\Http\Controllers\EHR\HETG;

use App\EHR\HETG\Profession;
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
        $professions = Profession::all();
        return view('ehr.hetg.professions.index', compact('professions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ehr.hetg.professions.create');
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
      $profession->user_id = Auth::id();
      $profession->save();

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
        return view('ehr.hetg.professions.edit', compact('profession'));
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
      $profession->user_id = Auth::id();
      $profession->save();

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
      $profession->delete();
      session()->flash('success', 'La profesión ha sido eliminada');
      return redirect()->route('ehr.hetg.professions.index');
    }
}
