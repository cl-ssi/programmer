@extends('layouts.app')

@section('title', 'Listado de usuarios')

@section('content')

@include('parameters.nav')

<h3 class="mb-3">Listado de usuarios</h3>

<form method="get" class="form-horizontal" action="{{ route('users.index') }}">

    <div class="form-row">
        @can('administrador')
        <div class="col-12 col-md-3 mb-3">
            <label for="" class="sr-only"></label>
            <a class="btn btn-primary" href="{{ route('users.create') }}">
                Crear usuario
            </a>
        </div>
        @endcan
        {{-- <div class="col-12 col-md-5 mb-3">
            <label for="" class="sr-only"></label>
            <input class="form-control" type="text" name="search" value="" placeholder="Nombre y/o apellido">
        </div>

        <div class="col-12 col-md-2 mb-3">
            <label for="" class="sr-only"></label>
            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-search"></i> Buscar</button>
        </div> --}}
    </div>

</form>



{{-- <h5>
        @if($search)
        <div class="alert alert-primary" role="alert">
            Los resultados para tu búsqueda "{{ $search }}" son:
        </div>
        @endif
</h5> --}}

<div class="table-responsive">
    <table class="table table-sm">
        <thead>
            <tr>
                <th>Rut</th>
                <th>Nombre</th>
                <th>Rol</th>
                <!-- <th>Servicio</th> -->
                <th>Prof/Espec</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td nowrap>{{ $user->id }} - {{ $user->dv }}</td>
                <td nowrap><a href="{{ route('users.edit', $user) }}">{{ $user->name }}</a></td>
                <td nowrap>
                    @foreach ($user->roles as $key => $role)
                        {{$role->name}},
                    @endforeach
                </td>
                <!-- <td nowrap>
                    @foreach ($user->services as $key => $service)
                        {{$service->service_name}},
                        @if ($key == 2)
                            @break
                        @endif
                    @endforeach
                </td> -->
                <td nowrap>
                    @foreach ($user->specialties as $key => $specialty)
                        {{$specialty->specialty_name}},
                        @if ($key == 2)
                            @break
                        @endif
                    @endforeach
                    @foreach ($user->professions as $key => $profession)
                        {{$profession->profession_name}},
                        @if ($key == 2)
                            @break
                        @endif
                    @endforeach
                </td>
                <td nowrap>{{ $user->email }}</td>
            </tr>
            @endforeach

        </tbody>
    </table>

    {{-- {{$user->logs}} --}}
</div>

@endsection

@section('custom_js')

@endsection
