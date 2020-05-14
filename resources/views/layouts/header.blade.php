
<header>
    
    <div id="header_gestor_blogs">

        <div id="div_cruds">
            @if (session()->get('usuario') == 'admin')

            <div>
                <a class="btn btn-info" href="{{url('/creacionBlog')}}">Crea tu blog</a>
            </div>
            
            <div>
                <a class="btn btn-warning" href="{{url('/crudUsuarios')}}">Crud Usuarios</a> 
            </div>

            @elseif (session()->get('usuario') == 'basico')

            <div id="crea_blog_usuarioNormal">
                <a class="btn btn-info" href="{{url('/creacionBlog')}}">Crea tu blog</a>
            </div>

            @endif

        </div>


        <a href="{{url('/')}}"><h1>Gestor de Blogs</h1></a>

        

        @if (session()->get('usuario') == 'admin')

            <div id="div_login_registro">
                <span>Hola {{Auth::user()->usuario}}</span>
                <a href="{{url('/logout')}}"><button>Logout</button></a>
                
            </div>
            
        @elseif (session()->get('usuario') == 'basico')
            
            <div id="div_login_registro">
                <span>Hola {{Auth::user()->usuario}}</span>
                <a href="{{url('/logout')}}"><button>Logout</button></a>
            </div>

        @else
            <div id="div_login_registro">
                    <a class="btn btn-info" href="{{url('/login')}}">Login</a>
                    <a class="btn btn-info" href="{{url('/registro')}}">Registrate</a>                
            </div>
        @endif
    </div>
    
</header>

