@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Monitor de programación</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{-- Bienvenido <b>{{session('name')}}</b> - Estás identificado como <b>{{session('profile')}}</b> --}}
                    Bienvenido <b>{{Auth::user()->name}}</b>
                </div>

            </div>

            <br />
            <div class="card">
                <div class="card-header">Novedades</div>

                <div class="card-body">
                    <div class="alert alert-warning" role="alert">
                      <b>03/11/2020 - Semana volante</b>: Al arrastrar, modificar o eliminar un evento en programación teórica, se realiza la misma operación cada 7 semanas.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
