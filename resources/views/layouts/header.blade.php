
<header>
    
    <div id="header_gestor_blogs">

        <div id="div_cruds">
            @if (session()->get('rol') == 'admin')


                @if (session()->get('blog') != null)
                    <div {{--id="botonIrTuBlog"--}}>
                        <a href="{{url('/'.session()->get('blog'))}}" class="btn btn-primary">Ir a mi blog</a>
                    </div>
                @else
                    <div>
                        <a class="btn btn-info" href="{{url('/creacionBlog')}}">Crea tu blog</a>
                    </div>
                @endif

            <div>
                <a class="btn btn-warning" href="{{url('/crudUsuarios')}}">Administración</a> 
            </div>

            @elseif (session()->get('rol') == 'basico')

                @if (session()->get('blog') != null)
                    <div id="crea_blog_usuarioNormal">
                        <a href="{{url('/'.session()->get('blog'))}}" class="btn btn-primary">Ir a mi blog</a>
                    </div>
                @else
                    <div id="crea_blog_usuarioNormal">
                        <a class="btn btn-info" href="{{url('/creacionBlog')}}">Crea tu blog</a>
                    </div>
                @endif

            @endif

        </div>


        <a href="{{url('/')}}"><h1>Gestor de Blogs</h1></a>

        

        @if (session()->get('rol') != null)

            {{--<div id="div_login_registro">
                <a href="{{url('/usuario/'.session()->get('usuario')) }}" id="nombrePerfilHeader"><img src="{{asset('imagenes/perfil/'.session()->get('imagenPerfil')) }}" alt="icono perfil" id="fotoPerfilHeader"> {{session()->get('usuario')}}</a>
                <a href="{{url('/logout')}}" class="btn btn-info">Logout</a>
                
            </div>
            
        @elseif (session()->get('rol') == 'basico')--}}
            
            <div id="div_login_registro">
                <a href="{{url('/usuario/'.session()->get('usuario')) }}" id="nombrePerfilHeader"><img src="{{asset('imagenes/perfil/'.session()->get('imagenPerfil')) }}" alt="icono perfil" id="fotoPerfilHeader"> {{session()->get('usuario')}}</a>
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

