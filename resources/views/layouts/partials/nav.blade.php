<nav class="navbar navbar-expand-md navbar-light shadow-sm navbar-custom">
    <div class="container">
        {{-- <a class="navbar-brand" href="{{ url('/') }}">
        {{ config('app.name', 'Laravel') }}
        </a> --}}

        {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
        </button> --}}

        <a class="navbar-brand" href="{{ url('/home') }}">
                    <i class="fas fa-home"></i> {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @auth
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="{{ url('/home') }}">
                                <i class="fas fa-home"></i>
                                Home
                            </a>
                        </li> -->

                        @canany(['programador pabellon'])
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('ehr.hetg.operating_room_programming.index') }}">
                                    <i class="fas fa-calendar-alt fa-fw" style='color:green'></i>
                                    Programador de Pabellones
                                </a>
                            </li>
                        @endcanany

                        @canany(['programacion teorica'])
                            <li class="navbar-nav dropdown">

                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-calendar-alt fa-fw" style='color:red'></i> Programador Teórico
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                    @canany(['programacion medica'])
                                    <a class="dropdown-item" href="{{ route('ehr.hetg.theoretical_programming.index','tipo=1') }}">
                                        <i class="fas fa-calendar-alt fa-fw" style='color:red'></i> Programador Médico
                                    </a>
                                    @endcanany

                                    @canany(['programacion no medica'])
                                    <a class="dropdown-item" href="{{ route('ehr.hetg.theoretical_programming.index','tipo=2') }}">
                                        <i class="fas fa-calendar-alt fa-fw" style='color:red'></i> Programador No Médico
                                    </a>
                                    @endcanany

                                </div>
                            </li>
                        @endcanany

                        <!-- @canany(['programador'])
                        <li class="navbar-nav dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-calendar-alt fa-fw" style='color:blue'></i> Programador de Funcionarios
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{ route('ehr.hetg.calendar_programming.index') }}">
                                    <i class="fas fa-calendar-alt fa-fw" style='color:blue'></i> Pabellones
                                </a>

                                <a class="dropdown-item" href="{{ route('ehr.hetg.calendar_programming.indexbox') }}">
                                    <i class="fas fa-calendar-alt fa-fw" style='color:blue'></i> Box's
                                </a>
                            </div>

                        </li>
                        @endcanany -->

                        @canany(['reportes'])
                        <li class="navbar-nav dropdown">

                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-hospital"></i> Reportes
                            </a>

                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                <!-- <div class="dropdown-divider"></div> -->

                                <!-- <a class="dropdown-item" href="{{ route('ehr.hetg.calendar_programming.calendar_programmer_report') }}">
                                    <i class="fas fa-calendar-alt fa-fw"></i> Reporte de Programación
                                </a> -->

                                <a class="dropdown-item" href="{{ route('ehr.hetg.management.report.reportProgramedVsTeoric') }}">
                                    <i class="fas fa-book-medical fa-fw"></i> Programado vs Teórico
                                </a>

                                <hr>

                                <a class="dropdown-item" href="{{ route('ehr.hetg.management.report.specialty') }}">
                                    <i class="fas fa-book-medical fa-fw"></i> Reporte Especialidad
                                </a>

                                <a class="dropdown-item" href="{{ route('ehr.hetg.management.report.by_profesional') }}">
                                    <i class="fas fa-user-md fa-fw"></i> Reporte Profesional
                                </a>

                                <a class="dropdown-item" href="{{ route('ehr.hetg.management.report.weekly') }}">
                                    <i class="far fa-calendar-alt fa-fw"></i> Producción Semanal
                                </a>

                                <a class="dropdown-item" href="{{ route('ehr.hetg.management.report.diary') }}">
                                    <i class="far fa-calendar-alt fa-fw"></i> Producción Diario
                                </a>

                                <a class="dropdown-item" href="{{ route('ehr.hetg.management.report.report1') }}">
                                    <i class="far fa-calendar-alt fa-fw"></i> Consolidado producción urgencias
                                </a>

                                <!-- <a class="dropdown-item" href="{{ route('ehr.hetg.management.report.reportminsal') }}">
                                    <i class="far fa-calendar-alt fa-fw"></i> Reporte Minsal
                                </a> -->

                                <hr>

                                <a class="dropdown-item" href="{{ route('ehr.hetg.theoretical_programming.programed_professionals') }}">
                                    <i class="fas fa-calendar-alt fa-fw"></i> Reporte funcionarios programados
                                </a>

                                <a class="dropdown-item" href="{{ route('ehr.hetg.theoretical_programming.programed_specialties') }}">
                                    <i class="fas fa-calendar-alt fa-fw"></i> Reporte especialidades programadas
                                </a>

                                <a class="dropdown-item" href="{{ route('ehr.hetg.theoretical_programming.programed_by_services') }}">
                                    <i class="fas fa-calendar-alt fa-fw"></i> Reporte servicios programados
                                </a>

                                <!-- <a class="dropdown-item" href="{{ route('ehr.hetg.calendar_programming.programed_in_pavilions') }}">
                                    <i class="fas fa-calendar-alt fa-fw"></i> Reporte programados en pabellones
                                </a> -->

                            </div>
                        </li>
                        @endcanany

                        @canany(['mantenedores'])
                        <li class="navbar-nav dropdown">

                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-hospital"></i> Mantenedores
                            </a>

                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{ route('ehr.hetg.rrhh.index') }}">
                                    <i class="fas fa-users fa-fw"></i> RRHH
                                </a>

                                <a class="dropdown-item" href="{{ route('ehr.hetg.contracts.index') }}">
                                    <i class="fas fa-file-contract fa-fw"></i> Contratos
                                </a>

                                <!-- <a class="dropdown-item" href="{{ route('ehr.hetg.operating_rooms.index') }}">
                                    <i class="fas fa-person-booth fa-fw"></i> Pabellones
                                </a> -->

                                <!-- <a class="dropdown-item"
                                        href="{{ route('ehr.hetg.mother_activities.index') }}">
                                <i class="fas fa-file-contract fa-fw"></i> Actividades Madre
                                </a> -->

                                <a class="dropdown-item" href="{{ route('ehr.hetg.activities.index') }}">
                                    <i class="fas fa-file-contract fa-fw"></i> Actividades
                                </a>

                                <a class="dropdown-item" href="{{ route('ehr.hetg.services.index') }}">
                                    <i class="fas fa-file-contract fa-fw"></i> Servicios
                                </a>

                                <a class="dropdown-item" href="{{ route('ehr.hetg.specialties.index') }}">
                                    <i class="fas fa-file-contract fa-fw"></i> Especialidades (Rdtos sugeridos)
                                </a>

                                <a class="dropdown-item" href="{{ route('ehr.hetg.professions.index') }}">
                                    <i class="fas fa-file-contract fa-fw"></i> Profesiones (Rdtos sugeridos)
                                </a>

                                <a class="dropdown-item" href="{{ route('ehr.hetg.cutoffdates.index') }}">
                                    <i class="fas fa-file-contract fa-fw"></i> Fechas de corte
                                </a>

                                <!-- <a class="dropdown-item"
                                        href="{{ route('ehr.hetg.unscheduled_programming.index') }}">
                                <i class="fas fa-notes-medical fa-fw"></i> Programación
                                </a> -->

                                <a class="dropdown-item" href="{{ route('ehr.hetg.clone.index') }}">
                                    <i class="fas fa-file-contract fa-fw"></i> Clonar
                                </a>

                            </div>
                        </li>
                        @endcanany

                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif -->
                        @else
                        <li class="nav-item dropdown">

                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @can('administrador')
                                <a class="nav-link" href="{{ route('parameters.index') }}">
                                    <i class="fas fa-cog fa-fw"></i> Configuracion
                                </a>
                                @endcan

                                <a class="nav-link" href="{{ route('password.edit') }}">
                                    <i class="fas fa-key fa-fw"></i> Manuales
                                </a>

                                <a class="nav-link" href="{{ route('password.edit') }}">
                                    <i class="fas fa-key fa-fw"></i> Cambiar Clave
                                </a>

                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Cerrar Sesión
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>

    </div>
</nav>
