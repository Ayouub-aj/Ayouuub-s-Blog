<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BlogPersonal')</title>
    <link rel="icon" type="image/svg+xml" href='data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64"%3E%3Crect width="64" height="64" rx="12" fill="%231d4ed8"/%3E%3Cpath d="M20 16h24a4 4 0 0 1 4 4v24a4 4 0 0 1-4 4H20a4 4 0 0 1-4-4V20a4 4 0 0 1 4-4Zm4 8v4h16v-4H24Zm0 8v4h16v-4H24Zm0 8v4h10v-4H24Z" fill="white"/%3E%3C/svg%3E'>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f3f6fb;
            background-image:
                radial-gradient(circle at 8% 10%, rgba(59, 130, 246, 0.16), transparent 22%),
                radial-gradient(circle at 92% 20%, rgba(147, 51, 234, 0.12), transparent 24%),
                linear-gradient(180deg, #f8fbff 0%, #eef3fb 100%);
            color: #1f2937;
            line-height: 1.6;
        }

        nav {
            background: #0f172a;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #1e293b;
        }

        nav a.brand {
            color: #f8fafc;
            font-size: 1.4rem;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
        }

        .brand-icon {
            width: 26px;
            height: 26px;
            border-radius: 7px;
            background: linear-gradient(135deg, #3b82f6, #6366f1);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 14px rgba(59, 130, 246, 0.35);
            font-size: 0.95rem;
            line-height: 1;
        }

        nav .nav-links {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        nav .nav-links a {
            color: #cbd5e1;
            text-decoration: none;
            font-size: 0.95rem;
            padding: 0.35rem 0.6rem;
            border-radius: 8px;
            transition: background 0.2s, color 0.2s;
        }

        nav .nav-links a:hover {
            color: white;
            background: #1e293b;
        }

        nav .nav-links button {
            background: #ef4444;
            color: white;
            border: none;
            padding: 0.45rem 0.9rem;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .container {
            max-width: 1040px;
            margin: 2rem auto;
            padding: 0 1.25rem;
        }

        .site-footer {
            margin-top: 2.5rem;
            border-top: 1px solid #e2e8f0;
            background: #ffffff;
        }

        .site-footer-inner {
            max-width: 1040px;
            margin: 0 auto;
            padding: 1.4rem 1.25rem 1.7rem;
        }

        .social-title {
            font-size: 0.95rem;
            color: #475569;
            margin-bottom: 0.8rem;
        }

        .social-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
            gap: 0.7rem;
        }

        .social-link {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            text-decoration: none;
            border: 1px solid #dbeafe;
            background: #f8fbff;
            color: #0f172a;
            border-radius: 10px;
            padding: 0.7rem 0.8rem;
            transition: transform 0.18s ease, box-shadow 0.18s ease, border-color 0.18s ease;
        }

        .social-link:hover {
            transform: translateY(-2px);
            border-color: #93c5fd;
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.14);
        }

        .social-icon {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        .social-name {
            font-weight: 700;
            font-size: 0.9rem;
        }

        .social-note {
            margin-top: 0.9rem;
            color: #64748b;
            font-size: 0.82rem;
        }

        .page-header {
            margin-bottom: 1.25rem;
        }

        .page-title {
            font-size: 1.9rem;
            margin-bottom: 0.35rem;
            color: #0f172a;
        }

        .muted {
            color: #64748b;
            font-size: 0.95rem;
        }

        .stack {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .toolbar {
            display: flex;
            flex-wrap: wrap;
            gap: 0.6rem;
            margin-bottom: 1rem;
            align-items: center;
        }

        .card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 1.1rem;
            box-shadow: 0 6px 18px rgba(15, 23, 42, 0.04);
        }

        .btn,
        .btn-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
            padding: 0.5rem 0.85rem;
            border-radius: 8px;
            border: 1px solid transparent;
            text-decoration: none;
            font-size: 0.92rem;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-primary {
            background: #2563eb;
            color: #fff;
        }

        .btn-secondary {
            background: #ffffff;
            color: #334155;
            border-color: #cbd5e1;
        }

        .btn-danger {
            background: #ef4444;
            color: #fff;
        }

        .btn-link {
            color: #2563eb;
            padding: 0;
            border: none;
            background: none;
        }

        .form-card {
            max-width: 720px;
        }

        .form-group {
            margin-bottom: 0.95rem;
        }

        label {
            display: block;
            margin-bottom: 0.4rem;
            font-weight: 600;
            color: #334155;
        }

        input,
        select,
        textarea {
            width: 100%;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 0.65rem 0.75rem;
            font-size: 0.95rem;
            background: #fff;
            color: #0f172a;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: 2px solid #bfdbfe;
            border-color: #60a5fa;
        }

        .error-text {
            color: #b91c1c;
            font-size: 0.86rem;
            margin-top: 0.35rem;
        }

        .alert {
            border-radius: 10px;
            padding: 0.75rem 0.9rem;
            margin-bottom: 1rem;
            border: 1px solid;
            font-weight: 500;
        }

        .alert-success {
            color: #166534;
            background: #f0fdf4;
            border-color: #bbf7d0;
        }

        .alert-danger {
            color: #991b1b;
            background: #fef2f2;
            border-color: #fecaca;
        }

        table.table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
        }

        .table th,
        .table td {
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
            padding: 0.75rem;
            vertical-align: middle;
        }

        .table th {
            color: #334155;
            background: #f8fafc;
            font-size: 0.9rem;
        }

        .badge {
            display: inline-block;
            border-radius: 999px;
            padding: 0.2rem 0.65rem;
            font-size: 0.78rem;
            font-weight: 700;
            text-transform: capitalize;
            border: 1px solid #cbd5e1;
            background: #f8fafc;
            color: #334155;
        }

        .actions {
            display: flex;
            gap: 0.6rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .inline-form {
            display: inline;
        }

        .empty-state {
            text-align: center;
            color: #64748b;
            padding: 2rem 1rem;
        }

        .pagination-wrap nav {
            margin-top: 1rem;
        }

        .custom-pagination {
            display: flex;
            flex-wrap: wrap;
            gap: 0.45rem;
            align-items: center;
        }

        .page-btn {
            min-width: 38px;
            text-align: center;
            border-radius: 8px;
            padding: 0.45rem 0.65rem;
            border: 1px solid #cbd5e1;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
        }

        .page-number {
            background: #ffffff;
            color: #1e293b;
        }

        .page-number:hover,
        .page-nav:hover {
            background: #dbeafe;
            border-color: #60a5fa;
            color: #1d4ed8;
        }

        .page-active {
            background: #1d4ed8;
            border-color: #1d4ed8;
            color: #ffffff;
        }

        .page-nav {
            background: #ecfeff;
            border-color: #67e8f9;
            color: #155e75;
        }

        .page-disabled {
            background: #f1f5f9;
            border-color: #e2e8f0;
            color: #94a3b8;
            cursor: not-allowed;
        }

        .page-ellipsis {
            color: #64748b;
            padding: 0 0.2rem;
        }

        @yield('styles')
    </style>
</head>
<body>

    <nav>
        <a href="{{ route('articles.index') }}" class="brand">
            <span class="brand-icon" aria-hidden="true">✦</span>
            <span>BlogPersonal</span>
        </a>

        <div class="nav-links">
            @auth
                @if (Route::has('dashboard.index'))
                    <a href="{{ route('dashboard.index') }}">Dashboard</a>
                @endif
                @if (Route::has('manage.categories.index'))
                    <a href="{{ route('manage.categories.index') }}">Categories</a>
                @endif
                @if (Route::has('manage.users.index') && auth()->user()?->email === 'blogger@blog.com')
                    <a href="{{ route('manage.users.index') }}">Users</a>
                @endif
                @if (Route::has('logout'))
                    <form action="{{ route('logout') }}" method="POST" style="display:inline">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                @endif
            @endauth

            @guest
                @if (Route::has('login'))
                    <a href="{{ route('login') }}">Login</a>
                @endif
            @endguest
        </div>
    </nav>

    <main class="container">
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="site-footer-inner">
            <p class="social-title">Connect with Ayoub</p>

            <div class="social-grid">
                <a class="social-link" href="https://www.linkedin.com/in/idbelhajayoub/" target="_blank" rel="noopener noreferrer">
                    <svg class="social-icon" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M6.94 8.5H3.56V20h3.38V8.5ZM5.25 3C4.15 3 3.25 3.9 3.25 5s.9 2 2 2 2-.9 2-2-.9-2-2-2ZM20.75 13.06c0-3.22-1.72-4.72-4.01-4.72-1.85 0-2.68 1.02-3.14 1.74V8.5h-3.38V20h3.38v-6.05c0-1.6.3-3.15 2.28-3.15 1.95 0 1.98 1.82 1.98 3.25V20h3.39v-6.94Z"/>
                    </svg>
                    <span class="social-name">LinkedIn</span>
                </a>

                <a class="social-link" href="https://www.instagram.com/itsayouub.idb/" target="_blank" rel="noopener noreferrer">
                    <svg class="social-icon" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M7.5 2h9A5.5 5.5 0 0 1 22 7.5v9a5.5 5.5 0 0 1-5.5 5.5h-9A5.5 5.5 0 0 1 2 16.5v-9A5.5 5.5 0 0 1 7.5 2Zm0 1.8A3.7 3.7 0 0 0 3.8 7.5v9a3.7 3.7 0 0 0 3.7 3.7h9a3.7 3.7 0 0 0 3.7-3.7v-9a3.7 3.7 0 0 0-3.7-3.7h-9Zm9.75 1.35a1.05 1.05 0 1 1 0 2.1 1.05 1.05 0 0 1 0-2.1ZM12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10Zm0 1.8a3.2 3.2 0 1 0 0 6.4 3.2 3.2 0 0 0 0-6.4Z"/>
                    </svg>
                    <span class="social-name">Instagram</span>
                </a>

                <a class="social-link" href="https://x.com/ayouub__aj" target="_blank" rel="noopener noreferrer">
                    <svg class="social-icon" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M18.9 2h3.1l-6.77 7.74L23 22h-6.17l-4.84-6.32L6.46 22H3.35l7.24-8.28L1 2h6.33l4.38 5.79L18.9 2Zm-1.08 18.2h1.72L6.4 3.71H4.54l13.28 16.49Z"/>
                    </svg>
                    <span class="social-name">X</span>
                </a>

                <a class="social-link" href="https://github.com/Ayouub-aj" target="_blank" rel="noopener noreferrer">
                    <svg class="social-icon" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M12 .5a12 12 0 0 0-3.79 23.39c.6.11.82-.26.82-.57v-2.02c-3.34.73-4.04-1.43-4.04-1.43-.55-1.38-1.33-1.74-1.33-1.74-1.09-.74.09-.73.09-.73 1.2.08 1.84 1.24 1.84 1.24 1.07 1.84 2.8 1.31 3.49 1 .11-.78.42-1.31.76-1.61-2.67-.3-5.48-1.34-5.48-5.94 0-1.31.47-2.38 1.24-3.22-.12-.3-.54-1.53.12-3.19 0 0 1.01-.32 3.3 1.23a11.5 11.5 0 0 1 6 0c2.28-1.55 3.29-1.23 3.29-1.23.66 1.66.24 2.89.12 3.19.77.84 1.24 1.91 1.24 3.22 0 4.61-2.81 5.64-5.49 5.94.43.37.82 1.1.82 2.22v3.3c0 .31.21.69.83.57A12 12 0 0 0 12 .5Z"/>
                    </svg>
                    <span class="social-name">GitHub</span>
                </a>

                <a class="social-link" href="https://www.ayouubaj.ma" target="_blank" rel="noopener noreferrer">
                    <svg class="social-icon" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M3 5.75A2.75 2.75 0 0 1 5.75 3h12.5A2.75 2.75 0 0 1 21 5.75v12.5A2.75 2.75 0 0 1 18.25 21H5.75A2.75 2.75 0 0 1 3 18.25V5.75Zm6.5 2.25v8h5V8h-5Zm-1.5 0H6v8h2V8Zm8.5 0h-2v8h2V8Z"/>
                    </svg>
                    <span class="social-name">Portfolio</span>
                </a>
            </div>

            <p class="social-note">Built with focus, one commit at a time.</p>
        </div>
    </footer>

</body>
</html>