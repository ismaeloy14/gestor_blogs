<footer>
    <div id="div_footer_blog_autor">
        <span>
            <b>Autor:</b> {{$usuario->usuario}}
        </span>
        <span>
            <b>Email:</b> {{$usuario->email}}
        </span>

        @if ($usuario->paginaWeb != null)
            <span>
                <b>Página Web: </b> <a href="{{$usuario->paginaWeb}}" target="_blank" rel="nofollow">{{$usuario->paginaWeb}}</a>
            </span>            
        @endif
    </div>
    <div id="div_footer_blog_redes">

        <h3>Redes sociales del autor</h3>
        
        @if ($usuario->twitter != null)
            <a href="https://twitter.com/Ismaeloy14" target="_blank" rel="nofollow"><img src="{{asset('imagenes_redes/twitter.svg')}}" id="iconoTwitter" alt="Icono de twitter con enlace al perfil del usuario"></a>
        @endif

        @if ($usuario->facebook != null)
            <a href="https://www.facebook.com/prototype.angulo" target="_blank" rel="nofollow"><img src="{{asset('imagenes_redes/facebook.svg')}}" id="iconoFacebook" alt="Icono de facebook con enlace al perfil del usuario"></a>
        @endif

        @if ($usuario->instagram != null)
            <a href="https://www.instagram.com/ismaeloy14/?hl=es" target="_blank" rel="nofollow"><img src="{{asset('imagenes_redes/instagram.svg')}}" id="iconoInstagram" alt="Icono de instagram con enlace al perfil del usuario"></a>
        @endif
    </div>
</footer>