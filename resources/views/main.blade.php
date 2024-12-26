<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>Microde</title>
</head>

<body class="d-flex flex-column min-vh-100" data-bs-theme="dark">
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                
                <a class="navbar-brand" href="/">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="d-inline-block align-top mt-1" width="30" height="24">
                    Microde
                </a>

                <!-- for mobile -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" aria-current="page" href="/"><i class="bi bi-house-door"></i> Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('problems*') ? 'active' : '' }}" href="/problems"><i class="bi bi-list-stars"></i> Problems</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('statistics*') ? 'active' : '' }}" href="/statistics"><i class="bi bi-activity"></i> Statistics</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('aboutus*') ? 'active' : '' }}" href="/aboutus"><i class="bi bi-info-square"></i> About Microde</a>
                        </li>
                    </ul>

                    <hr class=".d-none .d-md-block .d-lg-none border-2 my-0"></hr>

                    <div class="d-flex">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            @auth
                            <span class="navbar-text text-white me-2">
                                Hello, <strong>{{ Auth::user()->username }}</strong>.
                            </span>

                            @if (Auth::user()->is_admin == '1')
                            <li class="nav-item mx-2">
                                <a class="nav-link {{ request()->is('questions/create*') ? 'active' : '' }}" href="/questions/create"><i class="bi bi-upload"></i> Upload Documents</a>
                            </li>
                            <li class="nav-item mx-2">
                                <a class="nav-link {{ request()->is('sqldata*') ? 'active' : '' }}" href="/sqldata"><i class="bi bi-database-fill"></i> See Database</a>
                            </li>
                            @endif

                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger"><i class="bi bi-power"></i> Logout</button>
                                </form>
                            </li>

                            @endauth

                            @guest
                            <span class="navbar-text text-white me-2">
                                You are not Logged in.
                            </span>

                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('login*') ? 'active' : '' }}" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item d-flex align-items-center py-lg-2">
                                <div class="vr bg-white mx-2 d-none d-lg-block"></div>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('register*') ? 'active' : '' }}" href="{{ route('register') }}">Register</a>
                            </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>


    <!-- This is where the child view content will be inserted -->
    <main class="flex-fill">
        @yield('content')
    </main>

    <footer class="py-2 bg-body-tertiary">
        <div class="text-center p3 py-2 text-white fw-light fs-5">
            &copy; 2024 Microde
        </div>
    </footer>
</body>

</html>