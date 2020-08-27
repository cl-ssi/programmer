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
        </div>
    </div>
</div>
@endsection
