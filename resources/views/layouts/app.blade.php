<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ trans('text.elearning')}}</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet'
    type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->

    <link href="{{ url('css/app.css') }}" rel="stylesheet">

</head>
<body id="app-layout">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
               <!-- Branding Image -->
               {{ link_to('/home', trans('text.elearning'), array('class' => 'navbar-brand')) }}
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li>{{ link_to('/home', trans('text.home')) }}</li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li>{{ link_to('/login', trans('text.login')) }}</li>
                        <li>{{ link_to('/register', trans('text.register')) }}</li>
                    @else
                        <li class="dropdown pull-right">
                            {!! Html::decode(link_to('#', Auth::user()->name . '<span class="caret"></span>', [
                                    'class' => 'dropdown-toggle',
                                    'data-toggle' =>'dropdown',
                                    'role' => 'button',
                                    'aria-expanded' => 'false'
                                ])) !!}

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    {!! Html::decode(link_to('/profile', '<i class="fa fa-btn fa fa-user"></i>' . trans('text.profile'))) !!}
                                </li>
                                <li>
                                    {!! Html::decode(link_to('/password/' . auth()->user()->id, '<i class="fa fa-key fa-fw"></i>' . trans('text.changepassword'))) !!}
                                </li>
                                <li>
                                    {!! Html::decode(link_to('/logout', '<i class="fa fa-btn fa-sign-out"></i>' . trans('text.logout'))) !!}
                                </li>
                            </ul>
                        </li>
                        @if(!empty(auth()->user()->image))
                            {{ Html::image('pictures/profile/' . auth()->user()->image, '', ['class' => 'img-responsive img-circle pull-right', 'width' => '12%', 'height' => '12%']) }}
                       @endif
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
