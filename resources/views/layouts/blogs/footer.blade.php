<footer>
    @foreach ($usuario as $u)
    <div id="div_footer_blog_autor">
        <span>
            <b>Autor:</b> {{$u->usuario}}
        </span>
        <span>
            <b>Email:</b> {{$u->email}}
        </span>

        @if ($u->paginaWeb != null)
            <span>
                <b>Página Web: </b> <a href="{{$u->paginaWeb}}" target="_blank" rel="nofollow">{{$u->paginaWeb}}</a>
            </span>            
        @endif
    </div>
    <div id="div_footer_blog_redes">

        <h3>Redes sociales del autor</h3>
        
        @if ($u->twitter != null)
            <a href="https://twitter.com/Ismaeloy14" target="_blank" rel="nofollow"><img src="{{asset('imagenes_redes/twitter.svg')}}" alt="Icono de twitter con enlace al perfil del usuario"></a>
        @endif

        @if ($u->facebook != null)
            <a href="https://www.facebook.com/prototype.angulo" target="_blank" rel="nofollow"><img src="{{asset('imagenes_redes/facebook.svg')}}" style="border-radius: 20%;background-color: white" alt="Icono de facebook con enlace al perfil del usuario"></a>
        @endif

        @if ($u->instagram != null)
            <a href="https://www.instagram.com/ismaeloy14/?hl=es" target="_blank" rel="nofollow"><img src="{{asset('imagenes_redes/instagram.svg')}}" alt="Icono de instagram con enlace al perfil del usuario"></a>
        @endif
    </div>
    @endforeach
</footer>