
<header>
    {{-- HEADER DE BLOGS --}}
    <div id="header_blog">

            <div id="div_Inicio_Noticia">
                
                
                @if (session()->get('idUsuario') == $blog->idUsuario)
                    <div>
                        <a class="btn btn-info" href="{{url('/')}}">Página principal</a>
                    </div>

                    <div>
                        <a class="btn btn-primary" href="{{url('/'.$blog->tituloBlog.'/gestionarBlog')}}">Gestionar blog</a>
                    </div>
                    
                @else
                    <div id="div_botonInicio_solo">
                        <a class="btn btn-info" href="{{url('/')}}">Página principal</a>
                    </div>
                @endif

                
            </div>
            
            <a href="{{url('/'.$blog->tituloBlog)}}"><h1>{{$blog->tituloBlog}}</h1></a>

        

        @if (session()->get('rol') != null)

            {{--<div id="div_login_registro">
                
                <a href="{{url('/usuario/'.session()->get('usuario')) }}" id="nombrePerfilHeader"><img src="{{asset('imagenes/perfil/'.session()->get('imagenPerfil')) }}" alt="icono perfil" id="fotoPerfilHeader"> {{Auth::user()->usuario}}</a>
                <a href="{{url('/logout')}}" class="btn btn-info">Logout</a>
                
            </div>
            
        @elseif (session()->get('rol') == 'basico')--}}
            
            <div id="div_login_registro">
                <a href="{{url('/usuario/'.session()->get('usuario')) }}" id="nombrePerfilHeader"><img src="{{asset('imagenes/perfil/'.session()->get('imagenPerfil')) }}" alt="icono perfil" id="fotoPerfilHeader"> {{Auth::user()->usuario}}</a>
                <a href="{{url('/logout')}}" class="btn btn-info">Logout</a>
            </div>

        @else
            <div id="div_login_registro">
                    <a class="btn btn-info" href="{{url('/login')}}">Login</a>
                    <a class="btn btn-info" href="{{url('/registro')}}">Registrate</a>                
            </div>
        @endif
    </div>
    
</header>

