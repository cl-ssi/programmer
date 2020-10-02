<?php

namespace App\Http\Controllers\EHR\HETG;

use App\EHR\HETG\Contract;
use App\EHR\HETG\Rrhh;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ContractController extends Controller
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
        }else{$year = Carbon::now()->format('Y');}

        $contracts = Contract::where('year',$year)->get();
        return view('ehr.hetg.contracts.index', compact('contracts', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $rrhh = Rrhh::orderBy('name','ASC')->get();
      return view('ehr.hetg.contracts.create', compact('rrhh'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $contract = new Contract($request->All());
      //$contract->user_id = Auth::id();
      $contract->save();

      session()->flash('info', 'El contrato ha sido creado.');
      return redirect()->route('ehr.hetg.contracts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pharmacies\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pharmacies\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Contract $contract)
    {
      $rrhh = Rrhh::All();
      return view('ehr.hetg.contracts.edit', compact('contract', 'rrhh'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pharmacies\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contract $contract)
    {
        $contract->fill($request->all());
        //$contract->user_id = Auth::id();
        $contract->save();

        session()->flash('info', 'El contrato ha sido editado.');
        return redirect()->route('ehr.hetg.contracts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pharmacies\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contract $contract)
    {
      //se elimina la cabecera y detalles
      $contract->delete();
      session()->flash('success', 'El contrato ha sido eliminado');
      return redirect()->route('ehr.hetg.contracts.index');
    }
}
