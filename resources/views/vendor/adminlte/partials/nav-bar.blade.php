<div class="navbar-custom-menu">

<ul class="nav navbar-nav">


    <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <img src="{{{Auth::user()->getImage() != null ?  Auth::user()->getImage() : '/img/users/0000-semfoto.jpg'}}}" class="user-image" alt="User Image">
        <span class="hidden-xs">{{{ isset(Auth::user()->name) ? Auth::user()->name.'|'.session()->get('tenant')->name : Auth::user()->email }}}</span>
        </a>
        <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
                <img src="{{{Auth::user()->getImage() != null ?  Auth::user()->getImage() : '/img/users/0000-semfoto.jpg'}}}" class="img-circle" alt="User Image">

                <p>
                {{{  Auth::user()->name  }}} - 
                <small>{{{Auth::user()->email}}}</small>
                </p>
            </li>

        </ul>
    </li>
    <!-- Control Sidebar Toggle Button -->
    <li>
        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
    </li>
    <li>
        @if(config('adminlte.logout_method') == 'GET' || !config('adminlte.logout_method') && version_compare(\Illuminate\Foundation\Application::VERSION, '5.3.0', '<'))
            <a href="{{ url(config('adminlte.logout_url', 'auth/logout')) }}">
                <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
            </a>
        @else
            <a href="#"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            >
                <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
            </a>
            <form id="logout-form" action="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" method="POST" style="display: none;">
                @if(config('adminlte.logout_method'))
                    {{ method_field(config('adminlte.logout_method')) }}
                @endif
                {{ csrf_field() }}
            </form>
        @endif
    </li>
</ul>
</div>