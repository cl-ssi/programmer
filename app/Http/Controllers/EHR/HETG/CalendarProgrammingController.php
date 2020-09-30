<?php

namespace App\Http\Controllers\EHR\HETG;

use App\EHR\HETG\MotherActivity;
use App\EHR\HETG\Activity;
use App\EHR\HETG\Rrhh;
use App\EHR\HETG\CalendarProgramming;
use App\EHR\HETG\TheoreticalProgramming;
use App\EHR\HETG\CutOffDate;
use App\EHR\HETG\MedicalProgramming;
use App\EHR\HETG\OperatingRoom;
use App\EHR\HETG\UserOperatingRoom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class CalendarProgrammingController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    // dd($request->get('date'));
    //primer form
    if ($request->get('date')) {
      $date = $request->get('date');
      $year = $request->get('year');
      $rut = $request->get('rut');
    } elseif ($request->get('date2')) {
      $date = $request->get('date2');
      $year = $request->get('year');
      $rut = $request->get('rut');
    } else {
      $date = Carbon::now();
      if ($request->get('year')) {
        $year = $request->get('year');
      } else {
        $year = $date->get('year');
      }
      $rut = $request->get('rut');
    }

    // $motherActivities = MotherActivity::where('id', 1)->get();
    // $ids_actividades = $motherActivities->first()->activities->pluck('id')->toArray(); //se obtienen actividades de pabellón

    // $rrhh = Rrhh::whereHas('contracts', function ($query) use ($year) {
    //                return $query->where('year',$year);
    //            })->get();

    //obtengo usuario propio
    $users = User::find(Auth::id());

    //obtengo rrhh segun especalidades asociadas al usuario logeado
    $rrhh = Rrhh::whereHas('contracts', function ($query) use ($year) {
      return $query->where('year', $year);
    })
      ->orderby('name', 'ASC')->get();









    // //obtiene bolsas de horas (TEÓRICAS) según fecha de corte
    // $cutoffdate = CutOffDate::orderBy('date', 'desc')->first();
    //
    // if ($cutoffdate == null) {
    //   session()->flash('danger', 'Para acceder al programador de horas, debe existir una fecha de corte.');
    //   return redirect()->back();
    // }
    //
    // $monday = Carbon::parse($cutoffdate->date)->startOfWeek();
    // $sunday = Carbon::parse($cutoffdate->date)->endOfWeek();

    $monday = Carbon::parse($date)->startOfWeek();
    $sunday = Carbon::parse($date)->endOfWeek();

    //obtiene datos programables del período
    $theoreticalProgrammings = TheoreticalProgramming::whereBetween('start_date', [$monday, $sunday])
      ->whereNull('contract_day_type')
      ->whereHas('activity', function ($query) {
        return $query->where('mother_activity_id', 1); //actividad de pabellón
      })
      ->get();

      // dd($theoreticalProgrammings);

    $formated_date = new Carbon($date);

    //obtiene datos NO programables del año
    $medicalProgrammings = MedicalProgramming::where('year', $formated_date->get('year'))->get();
    // dd($medicalProgrammings);

    //se obtiene fechas de inicio y termino de cada isEventOverDiv
    foreach ($theoreticalProgrammings as $key => $theoricalProgramming) {
      $start  = new Carbon($theoricalProgramming->start_date);
      $end    = new Carbon($theoricalProgramming->end_date);
      $theoricalProgramming->duration_theorical_programming = $start->diffInMinutes($end) / 60;
    }


    //programables - PROGRAMACION MÉDICA
    $array = array();
    foreach ($theoreticalProgrammings->whereNotNull('specialty_id') as $key => $theoricalProgramming) {
      $array[$theoricalProgramming->specialty->specialty_name][$theoricalProgramming->rut] = $theoricalProgramming->rrhh;
      $array[$theoricalProgramming->specialty->specialty_name][$theoricalProgramming->rut]['specialty_id'] = $theoricalProgramming->specialty_id;
      $array[$theoricalProgramming->specialty->specialty_name][$theoricalProgramming->rut]['color'] = $theoricalProgramming->specialty->color;
    }

    //obtiene valor bolsa de horas
    foreach ($theoreticalProgrammings->whereNotNull('specialty_id') as $key => $theoricalProgramming) {
      $array[$theoricalProgramming->specialty->specialty_name][$theoricalProgramming->rut]['assigned_hour'] += $theoricalProgramming->duration_theorical_programming;
    }

    //programables - PROGRAMACION MÉDICA
    foreach ($theoreticalProgrammings->whereNotNull('profession_id') as $key => $theoricalProgramming) {
      $array[$theoricalProgramming->profession->profession_name][$theoricalProgramming->rut] = $theoricalProgramming->rrhh;
      $array[$theoricalProgramming->profession->profession_name][$theoricalProgramming->rut]['profession_id'] = $theoricalProgramming->profession_id;
      $array[$theoricalProgramming->profession->profession_name][$theoricalProgramming->rut]['color'] = $theoricalProgramming->profession->color;
    }

    //obtiene valor bolsa de horas
    foreach ($theoreticalProgrammings->whereNotNull('profession_id') as $key => $theoricalProgramming) {
      $array[$theoricalProgramming->profession->profession_name][$theoricalProgramming->rut]['assigned_hour'] += $theoricalProgramming->duration_theorical_programming;
    }
    // dd($array);



    //pabellones
    // dd($request->operating_rooms);
    $operatingRoomsTotal = OperatingRoom::where('medic_box', 0)->orderBy('name', 'ASC')->get();
    $array_operating_room = $request->operating_rooms;
    $operatingRooms = OperatingRoom::where('medic_box', 0)
                                    ->when($array_operating_room, function ($q) use ($array_operating_room) {
                                        return $q->whereIn('id', $array_operating_room);
                                    })
                                    ->orderBy('name', 'ASC')->get();

    //obtiene horas programadas de la semana
    $monday = Carbon::parse($date)->startOfWeek();
    $sunday = Carbon::parse($date)->endOfWeek();
    $calendarProgrammings = CalendarProgramming::whereBetween('start_date', [$monday, $sunday])->whereNotNull('operating_room_id')
      ->when($rut != 0, function ($query) use ($rut) {
        return $query->where('rut', $rut);
      })->get();

    foreach ($calendarProgrammings as $key => $calendarProgramming) {
      $start  = new Carbon($calendarProgramming->start_date);
      $end    = new Carbon($calendarProgramming->end_date);
      $calendarProgramming->duration_calendar_programming = $start->diffInMinutes($end) / 60;
    }

    //obtiene horario teórico
    $theoreticalProgrammings = TheoreticalProgramming::whereBetween('start_date', [$monday, $sunday])
      ->whereHas('activity', function ($query) {
        return $query->where('mother_activity_id', 1); //solo trae horario programado de horas de pabellón
      })->get();

    //obtiene dia administrativos de la semana
    $contract_days = CalendarProgramming::whereBetween('start_date', [$monday, $sunday])->where('id', 100000)->get();

    //devuelve listado de todos los profesionales
    $rrhhs = Rrhh::whereHas('contracts', function ($query) use ($year) {
      return $query; //->where('year',$year);
    })->orderby('name', 'ASC')->get();


    //dd($rrhh->first()->contracts->first()->medical_programmings->whereIn('activity_id',$ids_actividades)->WhereIn('specialty_id',$ids_specialities));
    return view('ehr.hetg.management.programmer', compact('request', 'array', 'operatingRoomsTotal', 'operatingRooms', 'calendarProgrammings', 'contract_days', 'date', 'theoreticalProgrammings', 'rrhhs'));
  }

  public function indexbox(Request $request)
    {
      if ($request->get('date')) {
        $date = $request->get('date');
        $year = $request->get('year');
        $rut = $request->get('rut');
      } elseif ($request->get('date2')) {
        $date = $request->get('date2');
        $year = $request->get('year');
        $rut = $request->get('rut');
      } else {
        $date = Carbon::now();
        if ($request->get('year')) {
          $year = $request->get('year');
        } else {
          $year = $date->get('year');
        }
        $rut = $request->get('rut');
      }

      // $motherActivities = MotherActivity::where('id', 1)->get();
      // $ids_actividades = $motherActivities->first()->activities->pluck('id')->toArray(); //se obtienen actividades de pabellón

      // $rrhh = Rrhh::whereHas('contracts', function ($query) use ($year) {
      //                return $query->where('year',$year);
      //            })->get();

      //obtengo usuario propio
      $users = User::find(Auth::id());

      //obtengo rrhh segun especalidades asociadas al usuario logeado
      $rrhh = Rrhh::whereHas('contracts', function ($query) use ($year) {
        return $query->where('year', $year);
      })
        ->orderby('name', 'ASC')->get();









      //obtiene bolsas de horas (TEÓRICAS) según fecha de corte
      $cutoffdate = CutOffDate::orderBy('date', 'desc')->first();

      if ($cutoffdate == null) {
        session()->flash('danger', 'Para acceder al programador de horas, debe existir una fecha de corte.');
        return redirect()->back();
      }

      $monday = Carbon::parse($cutoffdate->date)->startOfWeek();
      $sunday = Carbon::parse($cutoffdate->date)->endOfWeek();
      //obtiene datos programables del período
      $theoreticalProgrammings = TheoreticalProgramming::whereBetween('start_date', [$monday, $sunday])
        ->whereNull('contract_day_type')
        ->whereHas('activity', function ($query) {
          return $query->where('mother_activity_id', 2); //Consulta Médica
        })
        ->get();

      $cutoff_date = new Carbon($cutoffdate->date);
      //obtiene datos NO programables del año
      $medicalProgrammings = MedicalProgramming::where('year', $cutoff_date->get('year'))->get();
      // dd($medicalProgrammings);

      //se obtiene fechas de inicio y termino de cada isEventOverDiv
      foreach ($theoreticalProgrammings as $key => $theoricalProgramming) {
        $start  = new Carbon($theoricalProgramming->start_date);
        $end    = new Carbon($theoricalProgramming->end_date);
        $theoricalProgramming->duration_theorical_programming = $start->diffInMinutes($end) / 60;
      }

      //programables - PROGRAMACION MÉDICA
      $array = array();
      // foreach ($theoreticalProgrammings->whereNotNull('specialty_id') as $key => $theoricalProgramming) {
      //   // $array[$theoricalProgramming->rrhh->getShortNameAttribute()][$theoricalProgramming->activity->activity_name] = $theoricalProgramming->rrhh;
      //   $array[$theoricalProgramming->rrhh->getShortNameAttribute()][$theoricalProgramming->activity->activity_name]['assigned_hour'] = null;
      //   $array[$theoricalProgramming->rrhh->getShortNameAttribute()][$theoricalProgramming->activity->activity_name]['specialty_id'] = $theoricalProgramming->specialty_id;
      //   $array[$theoricalProgramming->rrhh->getShortNameAttribute()][$theoricalProgramming->activity->activity_name]['color'] = $theoricalProgramming->specialty->color;
      // }
      //
      // //obtiene valor bolsa de horas
      // foreach ($theoreticalProgrammings->whereNotNull('specialty_id') as $key => $theoricalProgramming) {
      //   $array[$theoricalProgramming->rrhh->getShortNameAttribute()][$theoricalProgramming->activity->activity_name]['assigned_hour'] += $theoricalProgramming->duration_theorical_programming;
      // }

      // //programables - PROGRAMACION MÉDICA
      // foreach ($theoreticalProgrammings->whereNotNull('profession_id') as $key => $theoricalProgramming) {
      //   $array[$theoricalProgramming->rrhh->getShortNameAttribute()][$theoricalProgramming->activity->activity_name]['assigned_hour'] = null;
      //   $array[$theoricalProgramming->rrhh->getShortNameAttribute()][$theoricalProgramming->activity->activity_name]['profession_id'] = $theoricalProgramming->profession_id;
      //   $array[$theoricalProgramming->rrhh->getShortNameAttribute()][$theoricalProgramming->activity->activity_name]['color'] = $theoricalProgramming->profession->color;
      // }
      //
      // //obtiene valor bolsa de horas
      // foreach ($theoreticalProgrammings->whereNotNull('profession_id') as $key => $theoricalProgramming) {
      //   $array[$theoricalProgramming->rrhh->getShortNameAttribute()][$theoricalProgramming->activity->activity_name]['assigned_hour'] += $theoricalProgramming->duration_theorical_programming;
      // }
      // dd($array);
      foreach ($theoreticalProgrammings->whereNotNull('specialty_id') as $key => $theoricalProgramming) {
        $array[$theoricalProgramming->specialty->specialty_name][$theoricalProgramming->rut] = $theoricalProgramming->rrhh;
        $array[$theoricalProgramming->specialty->specialty_name][$theoricalProgramming->rut]['specialty_id'] = $theoricalProgramming->specialty_id;
        $array[$theoricalProgramming->specialty->specialty_name][$theoricalProgramming->rut]['color'] = $theoricalProgramming->specialty->color;
      }

      //obtiene valor bolsa de horas
      foreach ($theoreticalProgrammings->whereNotNull('specialty_id') as $key => $theoricalProgramming) {
        $array[$theoricalProgramming->specialty->specialty_name][$theoricalProgramming->rut]['assigned_hour'] += $theoricalProgramming->duration_theorical_programming;
      }

      //programables - PROGRAMACION MÉDICA
      foreach ($theoreticalProgrammings->whereNotNull('profession_id') as $key => $theoricalProgramming) {
        $array[$theoricalProgramming->profession->profession_name][$theoricalProgramming->rut] = $theoricalProgramming->rrhh;
        $array[$theoricalProgramming->profession->profession_name][$theoricalProgramming->rut]['profession_id'] = $theoricalProgramming->profession_id;
        $array[$theoricalProgramming->profession->profession_name][$theoricalProgramming->rut]['color'] = $theoricalProgramming->profession->color;
      }

      //obtiene valor bolsa de horas
      foreach ($theoreticalProgrammings->whereNotNull('profession_id') as $key => $theoricalProgramming) {
        $array[$theoricalProgramming->profession->profession_name][$theoricalProgramming->rut]['assigned_hour'] += $theoricalProgramming->duration_theorical_programming;
      }



      //pabellones
      $users = User::find(Auth::id());
      $operatingRoomsTotal = OperatingRoom::where('medic_box', 1)
                                          ->whereIn('id',$users->getOperatingRoomsArray())
                                          ->orderBy('name', 'ASC')
                                          ->get();
      $array_operating_room = $request->operating_rooms;
      // dd($array_operating_room);
      $operatingRooms = OperatingRoom::where('medic_box', 1)
                                     ->whereIn('id',$users->getOperatingRoomsArray())
                                     ->when($array_operating_room, function ($q) use ($array_operating_room) {
                                          return $q->whereIn('id', $array_operating_room);
                                      })
                                      ->orderBy('name', 'ASC')->get();

      //obtiene horas programadas de la semana
      $monday = Carbon::parse($date)->startOfWeek();
      $sunday = Carbon::parse($date)->endOfWeek();
      $calendarProgrammings = CalendarProgramming::whereBetween('start_date', [$monday, $sunday])->whereNotNull('operating_room_id')
        ->when($rut != 0, function ($query) use ($rut) {
          return $query->where('rut', $rut);
        })->get();

      foreach ($calendarProgrammings as $key => $calendarProgramming) {
        $start  = new Carbon($calendarProgramming->start_date);
        $end    = new Carbon($calendarProgramming->end_date);
        $calendarProgramming->duration_calendar_programming = $start->diffInMinutes($end) / 60;
      }

      //obtiene horario teórico
      $theoreticalProgrammings = TheoreticalProgramming::whereBetween('start_date', [$monday, $sunday])
        ->whereHas('activity', function ($query) {
          return $query->where('mother_activity_id', 1); //solo trae horario programado de horas de pabellón
        })->get();

      //obtiene dia administrativos de la semana
      $contract_days = CalendarProgramming::whereBetween('start_date', [$monday, $sunday])->where('id', 100000)->get();

      //devuelve listado de todos los profesionales
      $rrhhs = Rrhh::whereHas('contracts', function ($query) use ($year) {
        return $query; //->where('year',$year);
      })->orderby('name', 'ASC')->get();


      return view('ehr.hetg.management.programmerbox', compact('request', 'array', 'operatingRoomsTotal', 'operatingRooms', 'calendarProgrammings', 'contract_days', 'date', 'theoreticalProgrammings', 'rrhhs','users'));
    }


  // public function getData(Request $request)
  // {
  //   // if ($request->get('date')) {
  //   //   $date = $request->get('date');
  //   // }else{$date = Carbon::now();}
  //
  //   /* Los ids que representan las horas de pabellón */
  //   $ids_specialities = array('9','13','15','19','33'); //variable
  //   $ids_actividades = array('6','7','8');
  //
  //   $rrhh = Rrhh::whereHas('contracts', function ($query) {
  //                  return $query->where('year',2020);
  //               })->get();
  //
  //   $array = array();
  //   foreach ($rrhh as $key => $data) {
  //     foreach ($data->contracts->where('year',2020) as $key => $contract) {
  //       foreach ($contract->medical_programmings->whereIn('activity_id',$ids_actividades)
  //                                               ->whereIn('specialty_id',$ids_specialities) as $key => $medical_programming) {
  //         //dd($medical_programming->assigned_hour);
  //         $data->assigned_hour += $medical_programming->assigned_hour;
  //         $data->color = $medical_programming->Specialty->color;
  //         $data->specialty_id = $medical_programming->Specialty->id;
  //         $array[$this->formatear_cadena($medical_programming->Specialty->specialty_name)][$data->rut] = $data;
  //       }
  //     }
  //   }
  //
  //   $operatingRooms = OperatingRoom::orderBy('name','ASC')->get();
  //   $calendarProgrammings = CalendarProgramming::all();
  //   foreach ($calendarProgrammings as $key => $calendarProgramming) {
  //     $start  = new Carbon($calendarProgramming->start_date);
  //     $end    = new Carbon($calendarProgramming->end_date);
  //     $calendarProgramming->duration = $start->diffInMinutes($end)/60;
  //   }
  //
  //   return view('ehr.hetg.management.programmer', compact('array','operatingRooms','calendarProgrammings', 'request'));
  // }

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

  /*función que reemplaza espacios en blanco, puntos y parentesis por _ - además quita tildes **/
  public function formatear_cadena($cadena)
  {
    $no_permitidas = array("á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú", "ñ", "À", "Ã", "Ì", "Ò", "Ù", "Ã™", "Ã ", "Ã¨", "Ã¬", "Ã²", "Ã¹", "ç", "Ç", "Ã¢", "ê", "Ã®", "Ã´", "Ã»", "Ã‚", "ÃŠ", "ÃŽ", "Ã”", "Ã›", "ü", "Ã¶", "Ã–", "Ã¯", "Ã¤", "«", "Ò", "Ã", "Ã„", "Ã‹");
    $permitidas = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "n", "N", "A", "E", "I", "O", "U", "a", "e", "i", "o", "u", "c", "C", "a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "u", "o", "O", "i", "a", "e", "U", "I", "A", "E");
    $texto = str_replace($no_permitidas, $permitidas, $cadena);
    $texto = str_replace('}', '', str_replace('{', '', str_replace(',', '', str_replace('.', '', str_replace(')', '', str_replace('(', '', str_replace(' ', '_', $texto)))))));
    return $texto;
  }

  public function saveMyEvent(Request $request)
  {
    $calendarProgramming = new CalendarProgramming($request->all());
    $calendarProgramming->user_id = Auth::id();
    $calendarProgramming->save();
  }

  public function updateMyEvent(Request $request)
  {
    try {
      $start_date = new Carbon($request->start_date);
      $end_date = new Carbon($request->end_date);
      $start_date_start = new Carbon($request->start_date_start);
      $end_date_start = new Carbon($request->end_date_start);

      //modifica evento
      $theoreticalProgramming = CalendarProgramming::where('rut', $request->rut)
        ->where('specialty_id', $request->specialty_id)
        ->where('operating_room_id', $request->operation_room_id_start)
        ->where('start_date', $start_date_start)
        ->where('end_date', $end_date_start)->first();
      // Storage::put('errores.txt', $theoreticalProgramming->count());
      $theoreticalProgramming->start_date = $start_date;
      $theoreticalProgramming->end_date = $end_date;
      $theoreticalProgramming->operating_room_id = $request->operating_room_id;
      $theoreticalProgramming->save();
    } catch (\Exception $e) {
      Storage::put('errores.txt', $e->getMessage());
    }
  }

  //elimina, deja registro
  public function deleteMyEvent(Request $request)
  {
    $calendarProgramming = CalendarProgramming::where('rut', $request->rut)
      ->where('specialty_id', $request->specialty_id)
      ->where('operating_room_id', $request->operating_room_id)
      ->where('start_date', $request->start_date)
      ->where('end_date', $request->end_date);
    $calendarProgramming->delete(); //forceDelete
  }

  //elimina, no deja registro
  public function deleteMyEventForce(Request $request)
  {
    $calendarProgramming = CalendarProgramming::where('rut', $request->rut)
      ->where('specialty_id', $request->specialty_id)
      ->where('operating_room_id', $request->operating_room_id)
      ->where('start_date', $request->start_date)
      ->where('end_date', $request->end_date);
    $calendarProgramming->forceDelete();
  }


  /**
   * Display a listing of users from an OrganizationalUnit.
   *
   * @return \Illuminate\Http\Response
   */
  public function getDataFromDate($date)
  {
    // $authority = null;
    // $current_authority = Authority::getAuthorityFromDate($ou_id,Carbon::now(),'manager');
    // if($current_authority) {
    //     $authority = $current_authority->user;
    // }
    // $users = User::where('organizational_unit_id', $ou_id)->orderBy('name')->get();
    // if ($authority <> null) {
    // if(!$users->find($authority)) {
    //     $users->push($authority);
    // }}
    /* Los ids que representan las horas de pabellón */
    $ids_specialities = array('9', '13', '15', '19', '33'); //variable
    $ids_actividades = array('6', '7', '8');

    $rrhh = Rrhh::whereHas('contracts', function ($query) {
      return $query->where('year', 2020);
    })->get();

    $array = array();
    foreach ($rrhh as $key => $data) {
      foreach ($data->contracts->where('year', 2020) as $key => $contract) {
        foreach ($contract->medical_programmings->whereIn('activity_id', $ids_actividades)
          ->whereIn('specialty_id', $ids_specialities) as $key => $medical_programming) {
          //dd($medical_programming->assigned_hour);
          $data->assigned_hour += $medical_programming->assigned_hour;
          $data->color = $medical_programming->Specialty->color;
          $data->specialty_id = $medical_programming->Specialty->id;
          $array[$this->formatear_cadena($medical_programming->Specialty->specialty_name)][$data->rut] = $data;
        }
      }
    }

    //$operatingRooms = OperatingRoom::orderBy('name','ASC')->get();
    // $calendarProgrammings = CalendarProgramming::all();
    // foreach ($calendarProgrammings as $key => $calendarProgramming) {
    //   //$calendarProgramming->duration = $calendarProgramming->end_date->diffInSeconds($calendarProgramming->start_date);
    //   $start  = new Carbon($calendarProgramming->start_date);
    //   $end    = new Carbon($calendarProgramming->end_date);
    //   $calendarProgramming->duration = $start->diffInMinutes($end)/60;
    // }

    //return view('ehr.hetg.management.programmer', compact('array','operatingRooms','calendarProgrammings'));

    return $array;
  }

  public function calendar_programmer_report(Request $request)
  {
    /* Los ids que representan las horas de pabellón */
    // $ids_specialities = array('9','13','15','19','33'); //variable
    // $ids_actividades = array('6','7','8');
    $motherActivities = MotherActivity::where('id', 1)->get();
    $ids_actividades_pabellon = $motherActivities->first()->activities->pluck('id')->toArray(); //se obtienen actividades de pabellón

    $motherActivities = MotherActivity::where('id', 2)->get();
    $ids_actividades_consulta_medica = $motherActivities->first()->activities->pluck('id')->toArray(); //se obtienen actividades de pabellón

    $rrhhs = Rrhh::whereHas('contracts', function ($query) {
      return $query->where('year', 2020);
    })->get();

    $CalendarProgrammings = CalendarProgramming::orderBy('start_date', 'ASC')->get();
    foreach ($CalendarProgrammings as $key => $CalendarProgramming) {
      $CalendarProgramming->week = Carbon::parse($CalendarProgramming->start_date)->format("W");
    }

    $array = array();
    foreach ($rrhhs as $key => $rrhh) {
      foreach ($rrhh->contracts->where('year', 2020) as $key => $contract) {
        foreach ($contract->medical_programmings //->whereIn('activity_id',$ids_actividades)
          // ->whereIn('specialty_id',$ids_specialities)
          as $key => $medical_programming) {

          //se obtienen horas segun pabellon y consulta medica
          if (in_array($medical_programming->activity_id, $ids_actividades_pabellon)) {
            $rrhh->assigned_hour_activities_pabellon += $medical_programming->assigned_hour;
          }
          if (in_array($medical_programming->activity_id, $ids_actividades_consulta_medica)) {
            $rrhh->assigned_hour_activities_cons_medica += $medical_programming->assigned_hour;
          }

          //se obtienen otros subtotales
          $rrhh->assigned_hour += $medical_programming->assigned_hour;
          $rrhh->color = $medical_programming->Specialty->color;
          $rrhh->specialty_id = $medical_programming->Specialty->id;

          //obtiene info sumatoria de horas por semana
          $array2 = array();
          foreach ($CalendarProgrammings->where('rut', $rrhh->rut) as $key => $CalendarProgramming) {
            $array2[$rrhh->rut][$CalendarProgramming->week] = 0;
          }
          foreach ($CalendarProgrammings->where('rut', $rrhh->rut) as $key => $CalendarProgramming) {
            $start  = new Carbon($CalendarProgramming->start_date);
            $end    = new Carbon($CalendarProgramming->end_date);
            $array2[$rrhh->rut][$CalendarProgramming->week] += $start->diffInMinutes($end) / 60;
          }


          // según profesional, se obtiene objeto de rrhh, y su calendario programado
          $array[$this->formatear_cadena($medical_programming->Specialty->specialty_name)][$rrhh->rut]['rrhh'] = $rrhh;
          $array[$this->formatear_cadena($medical_programming->Specialty->specialty_name)][$rrhh->rut]['calendar_programming'] = $CalendarProgrammings->where('rut', $rrhh->rut);
          $array[$this->formatear_cadena($medical_programming->Specialty->specialty_name)][$rrhh->rut]['array'] = $array2;
        }
      }
    }

    // dd($array);



    //dd($array);
    return view('ehr.hetg.management.calendar_programmer_report', compact('array'));
  }
}
