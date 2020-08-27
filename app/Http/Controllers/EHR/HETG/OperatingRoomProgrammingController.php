<?php

namespace App\Http\Controllers\EHR\HETG;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\EHR\HETG\OperatingRoomProgramming;
use App\EHR\HETG\OperatingRoom;
use App\EHR\HETG\Specialty;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OperatingRoomProgrammingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //primer form
        if ($request->get('date')) {
          $date = $request->get('date');
          $year = $request->get('year');
          $operating_room= $request->get('operating_room');
        }
        elseif ($request->get('date2')) {
          $date = $request->get('date2');
          $year = $request->get('year');
          $operating_room= $request->get('operating_room');
        }
        else{
          $date = Carbon::now();
          if ($request->get('year')) {
              $year = $request->get('year');
          }else{$year = $date->get('year');}
          $operating_room = $request->get('operating_room');
        }

      // $motherActivities = MotherActivity::where('id',2)->get();
      // $ids_actividades = $motherActivities->first()->activities->pluck('id')->toArray(); //se obtienen actividades de pabellón teórico

      $monday = Carbon::parse($date)->startOfWeek();
      $sunday = Carbon::parse($date)->endOfWeek();
      // dd($monday, $sunday);

      $operatingRoomProgrammings = OperatingRoomProgramming::where('year',$year)
                                                    ->where('operating_room_id', $request->get('operating_room'))
                                                    ->whereBetween('start_date',[$monday,$sunday])
                                                    ->get();

      $operatingRooms = OperatingRoom::orderBy('name','ASC')->get();

      //obtengo usuario propio
      $users = User::find(Auth::id());

      //se obtienen especialidades registradas en mantenedor
      $specialties = Specialty::whereIn('id',$users->getSpecialtiesArray())->orderBy('specialty_name','ASC')->get();

      $monday = Carbon::parse($date)->startOfWeek();
      $sunday = Carbon::parse($date)->endOfWeek();

        return view('ehr.hetg.management.medical_ward_programmer', compact('request','operatingRooms','specialties','date','operatingRoomProgrammings'));
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
        //
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

    public function saveMyEvent(Request $request){
        $year = $request->year;
        $first_date = new Carbon($request->start_date);
        $last_date = new Carbon($request->end_date);

        if ($request->tipo_ingreso == 1) {
            $operatingRoomProgramming = new OperatingRoomProgramming();
            $operatingRoomProgramming->operating_room_id = $request->operating_room_id;
            $operatingRoomProgramming->specialty_id = $request->specialty_id;
            $operatingRoomProgramming->start_date = $first_date;
            $operatingRoomProgramming->end_date = $last_date;
            $operatingRoomProgramming->year = $year;
            $operatingRoomProgramming->user_id = Auth::id();
            $operatingRoomProgramming->save();
        }
        //se inserta desde esta semana hacia adelante
        else {
            while (date('Y', strtotime($first_date)) == $year) {
                $operatingRoomProgramming = new OperatingRoomProgramming();
                $operatingRoomProgramming->operating_room_id = $request->operating_room_id;
                $operatingRoomProgramming->specialty_id = $request->specialty_id;
                $operatingRoomProgramming->start_date = $first_date;
                $operatingRoomProgramming->end_date = $last_date;
                $operatingRoomProgramming->year = $year;
                $operatingRoomProgramming->user_id = Auth::id();
                $operatingRoomProgramming->save();

                $first_date = $first_date->addWeek(1);
                $last_date = $last_date->addWeek(1);
            }
        }

    }

    public function updateMyEvent(Request $request){
        try {

          // $this->buildXMLHeader();
          $year = $request->year;
          $start_date = new Carbon($request->start_date);
          $end_date = new Carbon($request->end_date);
          $start_date_start = new Carbon($request->start_date_start);
          $end_date_start = new Carbon($request->end_date_start);

          //solo se modifica el evento actual
          if ($request->tipo == 1) {
              $operatingRoomProgramming = OperatingRoomProgramming::where('operating_room_id',$request->operating_room_id)
                                                              ->where('specialty_id',$request->specialty_id)
                                                              ->where('start_date',$start_date_start)
                                                              ->where('end_date',$end_date_start)->first();
              $operatingRoomProgramming->start_date = $start_date;
              $operatingRoomProgramming->end_date = $end_date;
              $operatingRoomProgramming->save();
          }
          //se modifican todos los eventos hacia adelante
          else{
              while (date('Y', strtotime($start_date)) == $year) {
                  $operatingRoomProgramming = OperatingRoomProgramming::where('operating_room_id',$request->operating_room_id)
                                                                  ->where('specialty_id',$request->specialty_id)
                                                                  ->where('start_date',$start_date_start)
                                                                  ->where('end_date',$end_date_start)->first();
                  $operatingRoomProgramming->start_date = $start_date;
                  $operatingRoomProgramming->end_date = $end_date;
                  $operatingRoomProgramming->save();

                  $start_date = $start_date->addWeek(1);
                  $end_date = $end_date->addWeek(1);
                  $start_date_start = $start_date_start->addWeek(1);
                  $end_date_start = $end_date_start->addWeek(1);
              }
          }

        } catch (\Exception $e) {

            // return $e->getMessage();
            Storage::put('errores.txt', $e->getMessage());
        }
    }

    //elimina el dato - queda respaldo de la eliminación
    public function deleteMyEvent(Request $request){
      $year = $request->year;
      $first_date = new Carbon($request->start_date);
      $last_date = new Carbon($request->end_date);

      //solo se elimina el evento actual
        if ($request->tipo == 1) {
            $operatingRoomProgramming = OperatingRoomProgramming::where('operating_room_id',$request->operating_room_id)
                                                            ->where('specialty_id',$request->specialty_id)
                                                            ->where('start_date',$first_date)
                                                            ->where('end_date',$last_date);
            $operatingRoomProgramming->delete();
        }
        //se elimina desde el evento actual
        else{
            while (date('Y', strtotime($first_date)) == $year) {
                $operatingRoomProgramming = OperatingRoomProgramming::where('operating_room_id',$request->operating_room_id)
                                                                ->where('specialty_id',$request->specialty_id)
                                                                ->where('start_date',$first_date)
                                                                ->where('end_date',$last_date);
                $operatingRoomProgramming->delete();

                $first_date = $first_date->addWeek(1);
                $last_date = $last_date->addWeek(1);
            }
        }
    }

    //elimina el dato (cuando son movimientos en el calendario) - no queda respaldo
    public function deleteMyEventForce(Request $request){
      $year = $request->year;
      $first_date = new Carbon($request->start_date);
      $last_date = new Carbon($request->end_date);
      while (date('Y', strtotime($first_date)) == $year) {
          $operatingRoomProgramming = OperatingRoomProgramming::where('operating_room_id',$request->operating_room_id)
                                                          ->where('specialty_id',$request->specialty_id)
                                                          ->where('start_date',$first_date)
                                                          ->where('end_date',$last_date);
          $operatingRoomProgramming->forceDelete();

          $first_date = $first_date->addWeek(1);
          $last_date = $last_date->addWeek(1);
      }
    }
}
