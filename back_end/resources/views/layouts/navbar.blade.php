<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>YouEvento</title>

</head>
<style>
    .navbar-brand {
        color: #339898;
        font-weight: bold;
    }

    .navbar-nav {
        margin-left: auto;
    }

    
</style>

<body>
    <nav>
        <nav>
            <div class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm ">
                <div class="container  ">
                    <a class="navbar-brand" href="/" style="color: #141f38; font-size: 25px; "><span style="color: #023071; " class="nav-brand-two">C</span>N</a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link ml-5 navigation" href="{{ route('user.register') }}">Register</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link ml-5 navigation" href="{{ route('user.login') }}">Login</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div>
                </div>
            </div>
        </nav>

        <section>
            @yield('content')

        </section>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>