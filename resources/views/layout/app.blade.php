<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex: 1;
        }
        .footer {
            background-color: #1B2440;
            color: white;
            width: 100%;
            padding: 10px 0;
            font-size: 12px;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                <img src="https://my.mobeecars.com/images/assets/website_mobee_logo.png" alt="Logo" height="30">
            </a>
            <!-- Button to the right -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    @if(Request::is('/'))
                        <li class="nav-item">
                            <a class="nav-link" href="/car-price-filter">Car Price Filter</a>
                        </li>
                    @elseif(Request::is('car-price-filter'))
                        <li class="nav-item">
                            <a class="nav-link" href="/">Main</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </header>

    <main class="container mt-5">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container text-center">
            <span>&copy; {{ date('Y') }} Mobility Technologies Sdn. Bhd. All Rights Reserved</span>
        </div>
    </footer>

    <!-- Include Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
