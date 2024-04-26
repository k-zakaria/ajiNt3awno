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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/nav.css') }}" rel="stylesheet">

    <title>Capps News</title>

</head>

<body>
    <nav class="navbar nav1 navbar-expand-lg navbar-light bg-white fixed-top border">
        <div class="container">
            <!-- Navbar brand -->
            <a class="navbar-brand" href="/" style="color: #141f38; font-size: 25px; "><span style="color: #023071; " class="nav-brand-two">C</span>N</a>

            <!-- Search bar -->
            <div class="relative flex items-center">
                <a href="{{route('articles.search')}}">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                        <i class="fas fa-search text-gray-400"></i>
                    </span>
                </a>
            </div>

            <!-- Collapsible navbar content -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    @if(Auth::check())
                    @if(Auth::User()->role_id == 1)
                    <li><a class="nav-link ml-5 navigation" href="{{route('categories.index')}}">dashboard</a></li>
                    @elseif(Auth::User()->role_id == 2)
                    <li><a class="nav-link ml-5 navigation" href="{{route('articles.show')}}">dashboard</a></li>
                    @endif

                    <div class="navbar-nav align-items-center ms-auto">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle text-secondary" data-bs-toggle="dropdown" style="color: white;">
                                <img class="rounded-circle me-lg-2" src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : 'https://c8.alamy.com/compfr/2g7ft6h/parametre-fictif-de-photo-d-avatar-par-defaut-icone-d-image-de-profil-grise-homme-en-t-shirt-2g7ft6h.jpg' }}" alt="" style="width: 30px; height: 30px;">
                                <span class="d-none d-lg-inline-flex">{{ Auth::user()->name}}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end  border-0 rounded-0 rounded-bottom m-0" style="background:#ffffff">
                                <a href="{{route('user.profile')}}" class="dropdown-item text-secondary">Settings</a>
                                <a href="{{ route('user.logout') }}" class="dropdown-item text-secondary">Log Out</a>
                            </div>
                        </div>
                    </div>
                    @else
                    <li class="nav-item">
                        <a class="nav-link ml-5 navigation" href="{{ route('user.register') }}"><i class="fas fa-user-plus"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ml-5 navigation" href="{{ route('user.login') }}"><i class="fas fa-sign-in-alt"></i></a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Second navbar -->
    <nav class="navbar nav2 navbar-expand-lg navbar-light bg-white fixed-top shadow-sm" style="margin-top: 50px;">
        <div class="container collapse navbar-collapse border-top " id="navbarNav">
            <!-- Navbar brand -->

            <!-- Burger button for toggling the collapsed navbar -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon "></span>
            </button>

            <!-- Collapsible navbar content -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('articles.index') }}">Home</a>
                    </li>
                    @foreach($categorys as $category)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('articles.category', $category->id) }}">{{ $category->name}}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>



    <section class="main">
        @yield('content')

    </section>


    <footer class="mt-5 bg-dark text-body">
        <div class="container py-4 " style="color: #fff;">
            <hr class="w-100">
            <div class="row ">
                <div class="col-md-12 ">
                    <ul class="list-unstyled d-flex  justify-content-between" style="font-variant: normal; font-weight: 700; line-height: 26.4px;">
                        <div>
                            <li class="category">World</li>
                            <li class="category">Politics</li>
                            <li class="category">Business</li>
                        </div>
                        <div>
                            <li class="category">Culture</li>
                            <li class="category">Tech</li>
                            <li class="category">Science</li>
                            <li class="category">Health</li>
                        </div>
                        <div>
                            <li class="category">Sports</li>
                            <li class="category">Entertainment</li>
                            <li class="category">Travel</li>
                        </div>
                        <div>
                            <li class="category">Corporate Insolvency <br>Resolution Process</li>
                            <li class="category">Terms and Condition</li>
                            <li class="category">About us</li>
                            <li class="category">Contact Us</li>
                        </div>
                    </ul>
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <div class="col-md-4 ">
                        <h5 class="fs-1" style="font-family: 'Bariol', sans-serif;">CappsNews</h5>
                        <!-- Ajoutez ici le contenu spécifique de votre site -->
                    </div>
                    <div class="col-md-2">
                        <ul class="list-unstyled d-flex justify-content-evenly">
                            <li><a href="#"><i class="bi bi-facebook"></i> </a></li>
                            <li><a href="#"><i class="bi bi-twitter"></i> </a></li>
                            <li><a href="#"><i class="bi bi-instagram"></i> </a></li>
                            <li><a href="#"><i class="bi bi-whatsapp"></i> </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr class="w-100">
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    

</body>

</html>