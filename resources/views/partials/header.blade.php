
<!DOCTYPE html>
<html>
<head>
    <title>OSS Admin</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="container">

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('dashboard') }}">OSS Admin</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('view_all') }}">View All oss_admin</a></li>
        <li><a href="{{ URL::to('test_login') }}">Test Password</a></li>
        @if(isset($_SESSION["admin_app_user"]))
            @if ($_SESSION["admin_app_user"]=="auth_success")
            <li><a href="{{ URL::to('logout') }}">Logout</a></li>
            @else
            <li><a href="{{ URL::to('/') }}">Login</a></li>
            @endif
        @else
        <li><a href="{{ URL::to('/') }}">Login</a></li>
        @endif
        {{-- <li><a href="{{ URL::to('logout') }}">Logout</a></li> --}}
    </ul>
</nav>

