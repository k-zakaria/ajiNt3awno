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
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <title>Capps News</title>

</head>

<body>

    <div class="container-fluid position-relative d-flex p-0">
        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar  navbar-dark">
                <a href="/" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>CN</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle me-lg-2" src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : 'https://c8.alamy.com/compfr/2g7ft6h/parametre-fictif-de-photo-d-avatar-par-defaut-icone-d-image-de-profil-grise-homme-en-t-shirt-2g7ft6h.jpg' }}" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3 text-secondary">
                        <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                        <span>
                            {{ Auth::user()->role->name }}
                        </span>
                    </div>
                </div>
                @if(Auth::check())
                @if(Auth::User()->role_id == 1)
                <div class="navbar-nav w-100">
                    <a href="{{ route('categories.index')}}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Categories</a>
                    <a href="{{ route('users.get')}}" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Users</a>
                    <a href="{{ route('showarticles.admin')}}" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Status articles</a>
                    <a href="{{ route('showArchivedArticles.admin')}}" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Archived articles</a>
                    <a href="{{ route('showRefusedArticles.admin')}}" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Refused articles</a>
                    <a href="{{route('sattistique.start')}}" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Charts</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Pages</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{route('user.login')}}" class="dropdown-item">Sign In</a>
                            <a href="{{route('user.register')}}" class="dropdown-item">Sign Up</a>
                        </div>
                    </div>
                </div>


                @elseif(Auth::User()->role_id == 2)

                <div class="navbar-nav w-100">
                    <a href="{{ route('articles.show')}}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Articles</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Pages</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{route('user.login')}}" class="dropdown-item">Sign In</a>
                            <a href="{{route('user.register')}}" class="dropdown-item">Sign Up</a>
                        </div>
                    </div>
                </div>
                @endif
                @endif
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand  navbar-dark sticky-top px-4 py-0" style="background:#191C24">
                <a href="#" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control bg-black border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle text-secondary" data-bs-toggle="dropdown" style="color: white;">
                            <img class="rounded-circle me-lg-2" src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : 'https://c8.alamy.com/compfr/2g7ft6h/parametre-fictif-de-photo-d-avatar-par-defaut-icone-d-image-de-profil-grise-homme-en-t-shirt-2g7ft6h.jpg' }}" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">{{ Auth::user()->name}}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end  border-0 rounded-0 rounded-bottom m-0" style="background:#191C24">
                            <a href="{{route('user.profile')}}" class="dropdown-item text-secondary">Settings</a>
                            <a href="{{ route('user.logout') }}" class="dropdown-item text-secondary">Log Out</a>
                        </div>
                    </div>


                </div>
            </nav>
            <!-- Navbar End -->
            @yield('content')

            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>