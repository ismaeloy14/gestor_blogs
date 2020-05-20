
<header>
    
    <div id="header_blog">


        



        @foreach ($blog as $b)

            <div id="div_Inicio_Noticia">
                
                
                
                @if (session()->get('idUsuario') == $b->idUsuario)
                    <div>
                        <a class="btn btn-info" href="{{url('/')}}">Página principal</a>
                    </div>

                    <div>
                        <a class="btn btn-primary" href="{{url('/'.$b->tituloBlog.'/crearNoticia')}}">Crear noticia</a>
                    </div>
                    
                @else
                    <div id="div_botonInicio_solo">
                        <a class="btn btn-info" href="{{url('/')}}">Página principal</a>
                    </div>
                @endif

                
            </div>
            
            <a href="{{url('/'.$b->tituloBlog)}}"><h1>{{$b->tituloBlog}}</h1></a>
        @endforeach

        

        @if (session()->get('rol') == 'admin')

            <div id="div_login_registro">
                
                <a href="{{url('/usuario/'.session()->get('usuario')) }}" id="nombrePerfilHeader"><img src="{{asset('imagenes/perfil/'.session()->get('imagenPerfil')) }}" alt="icono perfil" id="fotoPerfilHeader"> {{Auth::user()->usuario}}</a>
                <a href="{{url('/logout')}}" class="btn btn-info">Logout</a>
                
            </div>
            
        @elseif (session()->get('rol') == 'basico')
            
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

