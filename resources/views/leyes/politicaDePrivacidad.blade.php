@extends('layouts.master')

@section('body')

<div id="div_principal">

    <h2 id="tituloPolitica">Política de Privacidad</h2>

    <div id="todoPolitica">

        <h3>Información básica sobre protección de datos</h3>

        <table>
            <tr>
                <td class="tdTituloTablaPoilitica">
                    <b>Responsable del tratamiento de sus datos</b>
                </td>
                <td>
                    Propietario de Gestor Blogs
                </td>
            </tr>

            <tr>
                <td class="tdTituloTablaPoilitica">
                    <b>Datos</b>
                </td>
                <td>
                    Datos de características personales y datos facilitados por los propios interesados
                </td>
            </tr>

            <tr>
                <td class="tdTituloTablaPoilitica">
                    <b>Legitimación del tratamiento</b>
                </td>
                <td>
                    Consentimiento del interesado en el momento de enviarnos el formulario rellenado con sus datos.
                </td>
            </tr>

            <tr>
                <td class="tdTituloTablaPoilitica">
                    <b>Destinatario de sus datos</b>
                </td>
                <td>
                    Al personal. No cederemos sus datos a terceros, excepto obligación legal (p.e., autoridades públicas o jueces).
                </td>
            </tr>

            <tr>
                <td class="tdTituloTablaPoilitica">
                    <b>Información adicional</b>
                </td>
                <td>
                    Puede consultar la información adicional y detallada sobre Protección de Datos más adelante en el presente documento.
                </td>
            </tr>
            
        </table>

        <h3>Información adicional</h3>

        <h4>1. Responsable del tratamiento de sus datos</h4>

        <div class="listasPolitica"> {{--contiene lista de Responsable del tratamiento de sus datos --}}
            <ul>
                <li>
                    <span><b>Identidad:</b> Gestor Blogs</span>
                </li>
            </ul>
            <ul>
                <li>
                    <span><b>Titular:</b> Ismael Angulo</span>
                </li>
            </ul>
            <ul>
                <li>
                    <span><b>NIF:</b> 29345871E</span>
                </li>
            </ul>
            <ul>
                <li>
                    <span><b>Direccón postal:</b> C/ Torrent del Batlle</span>
                </li>
            </ul>
            <ul>
                <li>
                    <span><b>Dirección electrónica:</b> infoGestorBlogs@gmail.com</span>
                </li>
            </ul>
            <ul>
                <li>
                    <span><b>Teléfono:</b> 932145689</span>
                </li>
            </ul>
        </div>

        <h4>2. Datos de usuario que tramitará Gestor Blogs</h4>

        <div class="listasPolitica"> {{--contiene lista de Datos de usuario que tramitará Gestor Blogs --}}

            <ul>
                <li>
                    <span><b>Datos de características personales: </b>Fecha de nacimiento, nombre y apellidos, nacionalidad, email</span>
                </li>
            </ul>

        </div>

        <h4>3. Período de conservación de los datos</h4>

        <div class="listasPolitica"> {{--contiene Período de conservación de los datos --}}

            <p><b>Gestor Blogs</b> conservará los datos personales que nos haya proporcionado.</p>

        </div>

        <h4>4. Destinatarios a los que comunicaremos sus datos</h4>

        <div class="listasPolitica"> {{--contiene Destinatarios a los que comunicaremos sus datos --}}

            <p>
                Podrán tener acceso a sus datos, el personal y la dirección de la empresa, así como, la empresa encargada del desarrollo y 
                mantenimiento del sitio web: <b>Dinahosting</b>. Sus datos no serán cedidos a terceros, excepto cuando exista una obligación legal.
            </p>

        </div>

        <h4>5. Derechos que le asisten</h4>

        <div class="listasPolitica"> {{--contiene Derechos que le asisten --}}

            <p>
                Finalmente, le informamos que, si lo desea, puede ejercer los derechos que el <b>RGPD 679/2016</b> reconoce a las personas interesadas a acceder a sus 
                datos a solicitar la rectificación de los datos inexactos, a oponerse al tratamiento de sus datos en determinadas circunstancias, 
                a cancelar el tratamiento de sus datos en determinadas circunstancias, a solicitar la supresión de sus datos cuando, entre otros motivos, 
                los datos ya no sean necesarios para la finalidad por la que se recogieron, en la omisión, a la limitación del tratamiento y a la portabilidad 
                de los datos, dirigiéndose por escrito a <b>infoGestorBlogs@gmail.com</b> con copia de su DNI.
            </p>

        </div>

        <h4>6. Cambios en la política de privacidad</h4>
        
        <div class="listasPolitica"> {{--contiene Cambios en la política de privacidad --}}

            <p>
                Para garantizar que nuestras directrices de protección de datos cumplan siempre con los requisitos legales actuales, 
                nos reservamos el derecho de realizar cambios para estar siempre adecuados a la legislación vigente.
            </p>

        </div>

    </div>


</div>



@include('layouts.footer')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    
    
@endsection