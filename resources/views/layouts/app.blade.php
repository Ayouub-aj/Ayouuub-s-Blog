<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlogPersonal</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f5f5f5;
            color: #333;
        }

        nav {
            background: #1a1a2e;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav a.brand {
            color: #e94560;
            font-size: 1.4rem;
            font-weight: bold;
            text-decoration: none;
        }

        nav .nav-links {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        nav .nav-links a {
            color: #ccc;
            text-decoration: none;
            font-size: 0.95rem;
        }

        nav .nav-links a:hover {
            color: white;
        }

        nav .nav-links button {
            background: #e94560;
            color: white;
            border: none;
            padding: 0.4rem 1rem;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .container {
            max-width: 900px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        @yield('styles')
    </style>
</head>
<body>

    <nav>
        <a href="/" class="brand">BlogPersonal</a>

        <div class="nav-links">
            @auth
                <a href="/dashboard">Dashboard</a>
                <form action="/logout" method="POST" style="display:inline">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            @endauth

            @guest
                <a href="/login">Login</a>
            @endguest
        </div>
    </nav>

    <main class="container">
        @yield('content')
    </main>

</body>
</html>