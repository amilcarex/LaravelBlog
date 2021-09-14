<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Blog Fer</title>
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('material') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('material') }}/img/favicon.png">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link href="{{ asset('material') }}/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
    <link href="{{ asset('css/pages.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet" />
</head>

<body class="body">

    <header class="header d-flex">
        <div class="d-flex container-links-header">
            <div class="d-flex main-links">
                <a class="header-link @if($current_page=='home' ) active @endif" href="{{route('public.home')}}">Home</a>
                <span class="div-header-link"> | </span>
                <a class="header-link  @if($current_page=='about' ) active @endif" href="{{route('public.about')}}">
                    About Me
                </a>
                <span class="div-header-link"> | </span>
                <a class="header-link @if($current_page=='blog' ) active @endif""  href=" {{route('public.blog')}}">
                    Blog
                </a>
            </div>
            <div class="container-login-link">
                <a class="header-link" href="{{route('login')}}">
                    Login
                </a>
            </div>
        </div>
    </header>



    @yield('content')



    @include('layouts.footers.public')

</body>

</html>