
<header>
    
    <div id="header_gestor_blogs">

        <div id="div_cruds">
            @if (session()->get('rol') == 'admin')

            <div>
                <a class="btn btn-info" href="{{url('/creacionBlog')}}">Crea tu blog</a>
            </div>
            
            <div>
                <a class="btn btn-warning" href="{{url('/crudUsuarios')}}">Gestionar Usuarios</a> 
            </div>

            @elseif (session()->get('rol') == 'basico')

            <div id="crea_blog_usuarioNormal">
                <a class="btn btn-info" href="{{url('/creacionBlog')}}">Crea tu blog</a>
            </div>

            @endif

        </div>


        <a href="{{url('/')}}"><h1>Gestor de Blogs</h1></a>

        

        @if (session()->get('rol') == 'admin')

            <div id="div_login_registro">
                <a href="{{url('/usuario/'.session()->get('usuario')) }}" id="nombrePerfilHeader"><img src="{{asset('imagenes/perfil/'.session()->get('imagenPerfil')) }}" alt="icono perfil" id="fotoPerfilHeader"> {{Auth::user()->usuario}}</a>
                <a href="{{url('/logout')}}" class="btn btn-info">Logout</a>
                
            </div>
            
        @elseif (session()->get('rol') == 'basico')
            
            <div id="div_login_registro">
                <a href="{{url('/usuario/'.session()->get('usuario')) }}"><img src="{{asset('imagenes/perfil/'.session()->get('imagenPerfil')) }}" alt="icono perfil" id="fotoPerfilHeader"> {{Auth::user()->usuario}}</a>
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

