<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config()->get('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body data-bs-theme="dark">
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">{{ config()->get('app.name') }}</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        @if (auth()->check())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="position-relative">
        @if (Session::has('success'))
            <div class="alert alert-success position-absolute" style="top:20px; right:20px; z-index:1000"
                role="alert">
                {{ Session::get('success') }}
            </div>
        @elseif(Session::has('error'))
            <div class="alert alert-danger position-absolute" style="top:20px; right:20px; z-index:1000" role="alert">
                {{ Session::get('error') }}
            </div>
        @endif
        @yield('content')
    </main>

    <script>
        $(document).ready(function() {
            setTimeout(function() {
                var alertElement = document.querySelectorAll('.alert');
                alertElement.forEach((el) => bootstrap.Alert.getOrCreateInstance(el).close())
            }, 10000); // 10 seconds in milliseconds
        });
    </script>
</body>

</html>
