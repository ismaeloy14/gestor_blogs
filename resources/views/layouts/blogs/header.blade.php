
<header>
    
    <div id="header_blog">

        @foreach ($blog as $b)
            <a href="{{url('/'.$b->tituloBlog)}}"><h1>{{$b->tituloBlog}}</h1></a>            
        @endforeach

        

        @if (session()->get('rol') == 'admin')

            <div id="div_login_registro">
                <span>Hola {{Auth::user()->usuario}}</span>
                <a href="{{url('/logout')}}"><button>Logout</button></a>
                
            </div>
            
        @elseif (session()->get('rol') == 'basico')
            
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

