@extends('layouts.ehr')

@section('title', 'Agregar nuevo usuario')

@section('content')

@include('ehr.nav')

<h3 class="mb-3">Agregar nuevo usuario</h3>

<form method="POST" class="form-horizontal" action="{{ route('ehr.patient.store') }}">
    @csrf
    @method('POST')

    <div class="row">

        <fieldset class="form-group col-2">
            <label for="for_id">RUN</label>
            <input type="text" class="form-control" id="for_id" name="id" required>
        </fieldset>

        <fieldset class="form-group col-1">
            <label for="for_dv">D.V.</label>
            <input type="text" class="form-control" id="for_dv" name="dv" required>
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_name">Nombres</label>
            <input type="text" class="form-control" id="for_name" name="name" required>
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_fathers_family">Apellido Paterno</label>
            <input type="text" class="form-control" id="for_fathers_family" placeholder="" name="fathers_family" required>
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_mothers_family">Apellido Materno</label>
            <input type="text" class="form-control" id="for_mothers_family" placeholder="" name="mothers_family" required>
        </fieldset>
    </div>

    <div class="row">

        <fieldset class="form-group col-3">
            <label for="for_birthDate">Fecha Nacimiento</label>
            <input type="date" class="form-control" id="for_birthDate" name="birthDate">
        </fieldset>


        <fieldset class="form-group col-2">
            <label for="for_gender">Genero</label>
            <select name="gender" id="for_gender" class="form-control">
                <option value="male">Hombre</option>
                <option value="female">Mujer</option>
                <option value="other">Otro</option>
                <option value="unknown">No identificado</option>
            </select>
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_nationality">Nacionalidad</label>
            <select name="nationality" id="for_nationality" class="form-control" required>
                <option disable></option>
                <option>Afganistán</option>
                <option>Albania</option>
                <option>Alemania</option>
                <option>Andorra</option>
                <option>Angola</option>
                <option>Antigua y Barbuda</option>
                <option>Arabia Saudita</option>
                <option>Argelia</option>
                <option>Argentina</option>
                <option>Armenia</option>
                <option>Australia</option>
                <option>Austria</option>
                <option>Azerbaiyán</option>
                <option>Bahamas</option>
                <option>Bangladés</option>
                <option>Barbados</option>
                <option>Baréin</option>
                <option>Bélgica</option>
                <option>Belice</option>
                <option>Benín</option>
                <option>Bielorrusia</option>
                <option>Birmania</option>
                <option>Bolivia</option>
                <option>Bosnia y Herzegovina</option>
                <option>Botsuana</option>
                <option>Brasil</option>
                <option>Brunéi</option>
                <option>Bulgaria</option>
                <option>Burkina Faso</option>
                <option>Burundi</option>
                <option>Bután</option>
                <option>Cabo Verde</option>
                <option>Camboya</option>
                <option>Camerún</option>
                <option>Canadá</option>
                <option>Catar</option>
                <option>Chad</option>
                <option>Chile</option>
                <option>China</option>
                <option>Chipre</option>
                <option>Ciudad del Vaticano</option>
                <option>Colombia</option>
                <option>Comoras</option>
                <option>Corea del Norte</option>
                <option>Corea del Sur</option>
                <option>Costa de Marfil</option>
                <option>Costa Rica</option>
                <option>Croacia</option>
                <option>Cuba</option>
                <option>Dinamarca</option>
                <option>Dominica</option>
                <option>Ecuador</option>
                <option>Egipto</option>
                <option>El Salvador</option>
                <option>Emiratos Árabes Unidos</option>
                <option>Eritrea</option>
                <option>Eslovaquia</option>
                <option>Eslovenia</option>
                <option>España</option>
                <option>Estados Unidos</option>
                <option>Estonia</option>
                <option>Etiopía</option>
                <option>Filipinas</option>
                <option>Finlandia</option>
                <option>Fiyi</option>
                <option>Francia</option>
                <option>Gabón</option>
                <option>Gambia</option>
                <option>Georgia</option>
                <option>Ghana</option>
                <option>Granada</option>
                <option>Grecia</option>
                <option>Guatemala</option>
                <option>Guyana</option>
                <option>Guinea</option>
                <option>Guinea ecuatorial</option>
                <option>Guinea-Bisáu</option>
                <option>Haití</option>
                <option>Honduras</option>
                <option>Hungría</option>
                <option>India</option>
                <option>Indonesia</option>
                <option>Irak</option>
                <option>Irán</option>
                <option>Irlanda</option>
                <option>Islandia</option>
                <option>Islas Marshall</option>
                <option>Islas Salomón</option>
                <option>Israel</option>
                <option>Italia</option>
                <option>Jamaica</option>
                <option>Japón</option>
                <option>Jordania</option>
                <option>Kazajistán</option>
                <option>Kenia</option>
                <option>Kirguistán</option>
                <option>Kiribati</option>
                <option>Kuwait</option>
                <option>Laos</option>
                <option>Lesoto</option>
                <option>Letonia</option>
                <option>Líbano</option>
                <option>Liberia</option>
                <option>Libia</option>
                <option>Liechtenstein</option>
                <option>Lituania</option>
                <option>Luxemburgo</option>
                <option>Madagascar</option>
                <option>Malasia</option>
                <option>Malaui</option>
                <option>Maldivas</option>
                <option>Malí</option>
                <option>Malta</option>
                <option>Marruecos</option>
                <option>Mauricio</option>
                <option>Mauritania</option>
                <option>México</option>
                <option>Micronesia</option>
                <option>Moldavia</option>
                <option>Mónaco</option>
                <option>Mongolia</option>
                <option>Montenegro</option>
                <option>Mozambique</option>
                <option>Namibia</option>
                <option>Nauru</option>
                <option>Nepal</option>
                <option>Nicaragua</option>
                <option>Níger</option>
                <option>Nigeria</option>
                <option>Noruega</option>
                <option>Nueva Zelanda</option>
                <option>Omán</option>
                <option>Países Bajos</option>
                <option>Pakistán</option>
                <option>Palaos</option>
                <option>Panamá</option>
                <option>Papúa Nueva Guinea</option>
                <option>Paraguay</option>
                <option>Perú</option>
                <option>Polonia</option>
                <option>Portugal</option>
                <option>Reino Unido</option>
                <option>República Centroafricana</option>
                <option>República Checa</option>
                <option>República de Macedonia</option>
                <option>República del Congo</option>
                <option>República Democrática del Congo</option>
                <option>República Dominicana</option>
                <option>República Sudafricana</option>
                <option>Ruanda</option>
                <option>Rumanía</option>
                <option>Rusia</option>
                <option>Samoa</option>
                <option>San Cristóbal y Nieves</option>
                <option>San Marino</option>
                <option>San Vicente y las Granadinas</option>
                <option>Santa Lucía</option>
                <option>Santo Tomé y Príncipe</option>
                <option>Senegal</option>
                <option>Serbia</option>
                <option>Seychelles</option>
                <option>Sierra Leona</option>
                <option>Singapur</option>
                <option>Siria</option>
                <option>Somalia</option>
                <option>Sri Lanka</option>
                <option>Suazilandia</option>
                <option>Sudán</option>
                <option>Sudán del Sur</option>
                <option>Suecia</option>
                <option>Suiza</option>
                <option>Surinam</option>
                <option>Tailandia</option>
                <option>Tanzania</option>
                <option>Tayikistán</option>
                <option>Timor Oriental</option>
                <option>Togo</option>
                <option>Tonga</option>
                <option>Trinidad y Tobago</option>
                <option>Túnez</option>
                <option>Turkmenistán</option>
                <option>Turquía</option>
                <option>Tuvalu</option>
                <option>Ucrania</option>
                <option>Uganda</option>
                <option>Uruguay</option>
                <option>Uzbekistán</option>
                <option>Vanuatu</option>
                <option>Venezuela</option>
                <option>Vietnam</option>
                <option>Yemen</option>
                <option>Yibuti</option>
                <option>Zambia</option>
                <option>Zimbabue</option>
            </select>
        </fieldset>


    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>

</form>

@endsection

@section('custom_js')

@endsection
