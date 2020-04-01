<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title', config('app.name', 'Blog'))</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">

    <link href="{{asset('css/libs.css')}}" rel="stylesheet">

    <style>
        footer {
            margin-top: 0;
            margin-bottom: 20px;
        }
    </style>

    @yield('styles')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">{{config('app.name', 'Blog')}}</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    @if (Route::has('login'))
                        @auth
                            @can('viewAdmin','App\User')
                                <li>
                                    <a href="{{route('admin')}}">Admin</a>
                                </li>
                            @endcan
                            <li>
                                 <a href="{{route('logout')}}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            </li>
                            <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @else
                            <li>
                                <a href="{{route('login')}}">Login</a>
                            </li>

                            @if (Route::has('register'))
                                <li>
                                    <a href="{{route('register')}}">Register</a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="container">
                @if (session('status'))
                    <div class="alert alert-info" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <!-- Page Content -->
                <div class="row">
                    <!-- Blog Post Content Column -->
                    <div class="col-lg-8">
                        <!-- Blog Post -->
                        @yield('content')
                    </div>
                    <!-- Blog Sidebar Widgets Column -->
                    <div class="col-md-4">
                        <!-- Side Widget Well -->
                        <div class="well">
                            <h4>Get the source code</h4>
                            <b><a href="https://github.com/Carleslc/laravel-course" target="_blank"><span class="fa fa-github"></span> GitHub</a></b>
                        </div>
                        <!-- Blog Categories Well -->
                        <div class="well">
                            <h4>Blog Categories</h4>
                            <div class="row">
                                <div class="col-lg-12">
                                    <ul class="list-unstyled">
                                        @foreach (App\Category::pluck('name') as $category)
                                            <li><a href="{{route('categories.show', $category)}}">{{$category}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <!-- Footer -->
                <footer>
                    <div class="row">
                        <div class="col-lg-12">
                            <a href="https://www.udemy.com/course/php-with-laravel-for-beginners-become-a-master-in-laravel/" target="_blank">
                                {{config('app.name', 'Laravel CMS')}}
                            </a>
                            <br/><br/>
                            <a rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/"><img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by-sa/4.0/88x31.png" /></a>
                            <br/><br/>
                            This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/">Creative Commons Attribution-ShareAlike 4.0 International License</a>.
                        </div>
                    </div>
                </footer>
            </div>
        </div>

    </div>

    @yield('footer')

    <!-- jQuery -->
    <script src="{{asset('js/libs.js')}}"></script>

    @yield('scripts')

</body>

</html>
