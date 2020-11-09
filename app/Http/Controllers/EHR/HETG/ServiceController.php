<?php

namespace App\Http\Controllers\EHR\HETG;

use App\EHR\HETG\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $services = Service::all();
    return view('ehr.hetg.services.index', compact('services'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view('ehr.hetg.services.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $service = new Service($request->All());
    $service->save();

    session()->flash('info', 'El servicio ha sido creado.');
    return redirect()->route('ehr.hetg.services.index');
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
  public function edit(Service $service)
  {
      return view('ehr.hetg.services.edit', compact('service'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Service $service)
  {
    $service->fill($request->all());
    $service->save();

    session()->flash('info', 'El servicio ha sido editado.');
    return redirect()->route('ehr.hetg.services.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Service $service)
  {
    $service->delete();
    session()->flash('success', 'El servicio ha sido eliminado');
    return redirect()->route('ehr.hetg.services.index');
  }
}
