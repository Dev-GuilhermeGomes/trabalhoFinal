<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'PS Studios')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <nav class="navbar">
        <a href="{{ url('/') }}" class="logo">PS Studios</a>

        <div class="nav-links">
            <a href="{{ route('studios.index') }}">Estúdios</a>

            @auth
                <a href="{{ route('dashboard') }}">Dashboard</a>

                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                    @csrf
                    <button type="submit">Sair</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Registar</a>
            @endauth
        </div>
    </nav>

    <main class="container">
        @if(session('success'))
            <div class="success-box">{{ session('success') }}</div>
        @endif

        @yield('content')

    </main>

    <script>
        function toggleDropdown() {
            document.getElementById('dropdownMenu').classList.toggle('show');
        }
        // Fecha o dropdown se clicares fora dele
        window.addEventListener('click', function (e) {
            if (!e.target.closest('.dropdown')) {
                document.getElementById('dropdownMenu').classList.remove('show');
            }
        });
    </script>

</body>

</html>