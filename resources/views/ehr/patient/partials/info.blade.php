@if(session('patient'))
<div class="alert alert-info d-print-none" role="alert">
    Usuario seleccionado: <strong class="text-capitalize">{{ session('patient')->fullName() }}</strong> 
    - <a href="{{ route('ehr.patient.forget') }}"> <i class="fas fa-broom"></i>Olvidar</a>
</div>
@endif
