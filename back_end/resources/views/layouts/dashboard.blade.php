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
    <link href="/css/style.css" rel="stylesheet">
    <title>Capps News</title>
    <style>
        .dropdown-menu a.dropdown-item:hover {
            background-color: black;
        }

        /********** Template CSS **********/
        :root {
            --primary: #EB1616;
            --secondary: #191C24;
            --light: #6C7293;
            --dark: #000000;
        }

        .back-to-top {
            position: fixed;
            display: none;
            right: 45px;
            bottom: 45px;
            z-index: 99;
        }


        /*** Spinner ***/
        #spinner {
            opacity: 0;
            visibility: hidden;
            transition: opacity .5s ease-out, visibility 0s linear .5s;
            z-index: 99999;
        }

        #spinner.show {
            transition: opacity .5s ease-out, visibility 0s linear 0s;
            visibility: visible;
            opacity: 1;
        }


        /*** Button ***/
        .btn {
            transition: .5s;
        }

        .btn-square {
            width: 38px;
            height: 38px;
        }

        .btn-sm-square {
            width: 32px;
            height: 32px;
        }

        .btn-lg-square {
            width: 48px;
            height: 48px;
        }

        .btn-square,
        .btn-sm-square,
        .btn-lg-square {
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: normal;
            border-radius: 50px;
        }


        /*** Layout ***/
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 250px;
            height: 100vh;
            overflow-y: auto;
            background: var(--secondary);
            transition: 0.5s;
            z-index: 999;
        }

        .content {
            margin-left: 250px;
            min-height: 100vh;
            background: var(--dark);
            transition: 0.5s;
        }

        @media (min-width: 992px) {
            .sidebar {
                margin-left: 0;
            }

            .sidebar.open {
                margin-left: -250px;
            }

            .content {
                width: calc(100% - 250px);
            }

            .content.open {
                width: 100%;
                margin-left: 0;
            }
        }

        @media (max-width: 991.98px) {
            .sidebar {
                margin-left: -250px;
            }

            .sidebar.open {
                margin-left: 0;
            }

            .content {
                width: 100%;
                margin-left: 0;
            }
        }


        /*** Navbar ***/
        .sidebar .navbar .navbar-nav .nav-link {
            padding: 7px 20px;
            color: var(--light);
            font-weight: 500;
            border-left: 3px solid var(--secondary);
            border-radius: 0 30px 30px 0;
            outline: none;
        }

        .sidebar .navbar .navbar-nav .nav-link:hover,
        .sidebar .navbar .navbar-nav .nav-link.active {
            color: var(--primary);
            background: var(--dark);
            border-color: var(--primary);
        }

        .sidebar .navbar .navbar-nav .nav-link i {
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--dark);
            border-radius: 40px;
        }

        .sidebar .navbar .navbar-nav .nav-link:hover i,
        .sidebar .navbar .navbar-nav .nav-link.active i {
            background: var(--secondary);
        }

        .sidebar .navbar .dropdown-toggle::after {
            position: absolute;
            top: 15px;
            right: 15px;
            border: none;
            content: "\f107";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            transition: .5s;
        }

        .sidebar .navbar .dropdown-toggle[aria-expanded=true]::after {
            transform: rotate(-180deg);
        }

        .sidebar .navbar .dropdown-item {
            padding-left: 25px;
            border-radius: 0 30px 30px 0;
            color: var(--light);
        }

        .sidebar .navbar .dropdown-item:hover,
        .sidebar .navbar .dropdown-item.active {
            background: var(--dark);
        }

        .content .navbar .navbar-nav .nav-link {
            margin-left: 25px;
            padding: 12px 0;
            color: var(--light);
            outline: none;
        }

        .content .navbar .navbar-nav .nav-link:hover,
        .content .navbar .navbar-nav .nav-link.active {
            color: var(--primary);
        }

        .content .navbar .sidebar-toggler,
        .content .navbar .navbar-nav .nav-link i {
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--dark);
            border-radius: 40px;
        }

        .content .navbar .dropdown-item {
            color: var(--light);
        }

        .content .navbar .dropdown-item:hover,
        .content .navbar .dropdown-item.active {
            background: var(--dark);
        }

        .content .navbar .dropdown-toggle::after {
            margin-left: 6px;
            vertical-align: middle;
            border: none;
            content: "\f107";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            transition: .5s;
        }

        .content .navbar .dropdown-toggle[aria-expanded=true]::after {
            transform: rotate(-180deg);
        }

        @media (max-width: 575.98px) {
            .content .navbar .navbar-nav .nav-link {
                margin-left: 15px;
            }
        }


        /*** Date Picker ***/
        .bootstrap-datetimepicker-widget.bottom {
            top: auto !important;
        }

        .bootstrap-datetimepicker-widget .table * {
            border-bottom-width: 0px;
        }

        .bootstrap-datetimepicker-widget .table th {
            font-weight: 500;
        }

        .bootstrap-datetimepicker-widget.dropdown-menu {
            padding: 10px;
            border-radius: 2px;
        }

        .bootstrap-datetimepicker-widget table td.active,
        .bootstrap-datetimepicker-widget table td.active:hover {
            background: var(--primary);
        }

        .bootstrap-datetimepicker-widget table td.today::before {
            border-bottom-color: var(--primary);
        }


        /*** Testimonial ***/
        .progress .progress-bar {
            width: 0px;
            transition: 2s;
        }


        /*** Testimonial ***/
        .testimonial-carousel .owl-dots {
            margin-top: 24px;
            display: flex;
            align-items: flex-end;
            justify-content: center;
        }

        .testimonial-carousel .owl-dot {
            position: relative;
            display: inline-block;
            margin: 0 5px;
            width: 15px;
            height: 15px;
            border: 5px solid var(--primary);
            border-radius: 15px;
            transition: .5s;
        }

        .testimonial-carousel .owl-dot.active {
            background: var(--dark);
            border-color: var(--primary);
        }
    </style>

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
                        <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
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
                    <a href="chart.html" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Charts</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Pages</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="signin.html" class="dropdown-item">Sign In</a>
                            <a href="signup.html" class="dropdown-item">Sign Up</a>
                            <a href="404.html" class="dropdown-item">404 Error</a>
                            <a href="blank.html" class="dropdown-item">Blank Page</a>
                        </div>
                    </div>
                </div>


                @elseif(Auth::User()->role_id == 2)

                <div class="navbar-nav w-100">
                    <a href="{{ route('articles.show')}}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Articles</a>
                    <a href="form.html" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Forms</a>
                    <a href="table.html" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Tables</a>
                    <a href="chart.html" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Charts</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Pages</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="signin.html" class="dropdown-item">Sign In</a>
                            <a href="signup.html" class="dropdown-item">Sign Up</a>
                            <a href="404.html" class="dropdown-item">404 Error</a>
                            <a href="blank.html" class="dropdown-item">Blank Page</a>
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
                            <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">John Doe</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end  border-0 rounded-0 rounded-bottom m-0" style="background:#191C24">
                            <a href="#" class="dropdown-item text-secondary">My Profile</a>
                            <a href="#" class="dropdown-item text-secondary">Settings</a>
                            <a href="{{ route('user.logout') }}" class="dropdown-item text-secondary">Log Out</a>
                        </div>
                    </div>


                </div>
            </nav>
            <!-- Navbar End -->
            @yield('content')

            <script src="{{ asset('js/main.js') }}"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <script>
                (function($) {
                    "use strict";

                    // Spinner
                    var spinner = function() {
                        setTimeout(function() {
                            if ($('#spinner').length > 0) {
                                $('#spinner').removeClass('show');
                            }
                        }, 1);
                    };
                    spinner();


                    // Back to top button
                    $(window).scroll(function() {
                        if ($(this).scrollTop() > 300) {
                            $('.back-to-top').fadeIn('slow');
                        } else {
                            $('.back-to-top').fadeOut('slow');
                        }
                    });
                    $('.back-to-top').click(function() {
                        $('html, body').animate({
                            scrollTop: 0
                        }, 1500, 'easeInOutExpo');
                        return false;
                    });


                    // Sidebar Toggler
                    $('.sidebar-toggler').click(function() {
                        $('.sidebar, .content').toggleClass("open");
                        return false;
                    });


                    // Progress Bar
                    $('.pg-bar').waypoint(function() {
                        $('.progress .progress-bar').each(function() {
                            $(this).css("width", $(this).attr("aria-valuenow") + '%');
                        });
                    }, {
                        offset: '80%'
                    });
                })(jQuery);
            </script>
</body>

</html>