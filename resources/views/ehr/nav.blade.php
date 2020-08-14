<ul class="nav nav-tabs mb-3 d-print-none">
    <li class="nav-item">
        <a class="nav-link {{ active('ehr.patient.index') }}"
            href="{{ route('ehr.patient.index') }}">
            <i class="fas fa-address-book"></i> Pacientes
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ active('ehr.hfa.entry.create') }}"
            href="{{ route('ehr.hfa.entry.create') }}">
            <i class="fas fa-calendar-plus"></i> Nuevo Ingreso
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ active('ehr.hfa.entry.index') }}"
            href="{{ route('ehr.hfa.entry.index') }}">
            <i class="fas fa-sign-in-alt"></i> Ingresos
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ active('ehr.hfa.egress.index') }}"
            href="{{ route('ehr.hfa.egress.index') }}">
            <i class="fas fa-walking"></i> Egresos
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ active('ehr.hfa.signature.sign') }}"
            href="{{ route('ehr.hfa.signature.sign') }}" target="_blank">
            <i class="fas fa-file-signature"></i> Firma
        </a>
    </li>

</ul>
