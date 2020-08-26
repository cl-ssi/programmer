<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        {{-- <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a> --}}

        {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button> --}}

        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->

            <ul class="navbar-nav">
                @if(session('profile') == "Administrador" || session('profile') == "Programador-teorico")
                    <a class="dropdown-item"
                        href="{{ route('ehr.hetg.theoretical_programming.index') }}">
                        <i class="fas fa-calendar-alt fa-fw" style='color:red'></i> Programador Teórico
                    </a>
                @endif

                @if(session('profile') == "Administrador" || session('profile') == "Programador-teorico")
                    <a class="dropdown-item"
                        href="{{ route('ehr.hetg.operating_room_programming.index') }}">
                        <i class="fas fa-calendar-alt fa-fw" style='color:green'></i> Programador de Pabellónes
                    </a>
                @endif

                @if(session('profile') == "Administrador" || session('profile') == "Programador-pabellon")
                    <a class="dropdown-item"
                        href="{{ route('ehr.hetg.calendar_programming.index') }}">
                        <i class="fas fa-calendar-alt fa-fw" style='color:blue'></i> Programador Pabellón
                    </a>
                @endif
            </ul>

            @if(session('profile') == "Administrador" || session('profile') == "Reportes")
                <li class="navbar-nav dropdown">

                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-hospital"></i> Reportes
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                        {{-- <div class="dropdown-divider"></div> --}}

                        <a class="dropdown-item"
                            href="{{ route('ehr.hetg.calendar_programming.calendar_programmer_report') }}">
                            <i class="fas fa-calendar-alt fa-fw"></i> Reporte de Programación
                        </a>

                        <a class="dropdown-item"
                            href="{{ route('ehr.hetg.management.report.specialty') }}">
                            <i class="fas fa-book-medical fa-fw"></i> Reporte Especialidad
                        </a>

                        <a class="dropdown-item"
                            href="{{ route('ehr.hetg.management.report.by_profesional') }}">
                            <i class="fas fa-user-md fa-fw"></i> Reporte Profesional
                        </a>

                        <a class="dropdown-item"
                            href="{{ route('ehr.hetg.management.report.weekly') }}">
                            <i class="far fa-calendar-alt fa-fw"></i> Producción Semanal
                        </a>

                        <a class="dropdown-item"
                            href="{{ route('ehr.hetg.management.report.diary') }}">
                            <i class="far fa-calendar-alt fa-fw"></i> Producción Diario
                        </a>

                        <a class="dropdown-item"
                            href="{{ route('ehr.hetg.management.report.report1') }}">
                            <i class="far fa-calendar-alt fa-fw"></i> Reporte 1
                        </a>

                        <a class="dropdown-item"
                            href="{{ route('ehr.hetg.management.report.reportminsal') }}">
                            <i class="far fa-calendar-alt fa-fw"></i> Reporte Minsal
                        </a>

                    </div>
                </li>
            @endif

            @if(session('profile') == "Administrador" || session('profile') == "Mantenedores")
                <li class="navbar-nav dropdown">

                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-hospital"></i> Mantenedores
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                        <a class="dropdown-item"
                            href="{{ route('ehr.hetg.rrhh.index') }}">
                            <i class="fas fa-users fa-fw"></i> RRHH
                        </a>

                        <a class="dropdown-item"
                            href="{{ route('ehr.hetg.operating_rooms.index') }}">
                            <i class="fas fa-person-booth fa-fw"></i> Pabellones
                        </a>

                        <a class="dropdown-item"
                            href="{{ route('ehr.hetg.specialties.index') }}">
                            <i class="fas fa-file-contract fa-fw"></i> Especialidades
                        </a>

                        <a class="dropdown-item"
                            href="{{ route('ehr.hetg.mother_activities.index') }}">
                            <i class="fas fa-file-contract fa-fw"></i> Actividades Madre
                        </a>

                        <a class="dropdown-item"
                            href="{{ route('ehr.hetg.activities.index') }}">
                            <i class="fas fa-file-contract fa-fw"></i> Actividades
                        </a>

                        <a class="dropdown-item"
                            href="{{ route('ehr.hetg.contracts.index') }}">
                            <i class="fas fa-file-contract fa-fw"></i> Contratos
                        </a>

                        <a class="dropdown-item"
                            href="{{ route('ehr.hetg.medical_programming.index') }}">
                            <i class="fas fa-notes-medical fa-fw"></i> Programación
                        </a>

                    </div>
                </li>
            @endif

            {{-- <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">

                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul> --}}
        </div>
    </div>
</nav>
