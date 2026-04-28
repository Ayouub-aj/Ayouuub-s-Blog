@extends('layouts.app')

@section('title', 'Login')

@section('styles')
    .login-wrap {
        display: grid;
        grid-template-columns: 1.05fr 1fr;
        gap: 1rem;
        align-items: stretch;
    }

    .login-hero {
        background: linear-gradient(135deg, #1d4ed8, #7c3aed);
        border-radius: 14px;
        color: #fff;
        padding: 2rem;
        min-height: 380px;
        box-shadow: 0 16px 30px rgba(29, 78, 216, 0.28);
    }

    .login-hero h2 {
        font-size: 1.8rem;
        margin-bottom: 0.65rem;
    }

    .login-hero p {
        color: #dbeafe;
        max-width: 44ch;
    }

    .login-points {
        margin-top: 1rem;
        padding-left: 1rem;
        color: #e0e7ff;
    }

    .login-panel {
        display: flex;
        align-items: center;
    }

    .login-panel .form-card {
        width: 100%;
        border: 1px solid #dbeafe;
        box-shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
    }

    .credentials-hint {
        margin-top: 0.9rem;
        padding: 0.75rem;
        border-radius: 10px;
        font-size: 0.9rem;
        background: #eff6ff;
        color: #1e3a8a;
        border: 1px solid #bfdbfe;
    }

    @media (max-width: 860px) {
        .login-wrap {
            grid-template-columns: 1fr;
        }
    }
@endsection

@section('content')
    <div class="login-wrap">
        <section class="login-hero">
            <h2>Welcome back</h2>
            <p>Sign in to access your editorial dashboard, manage drafts, publish new stories, and organize categories.</p>

            <ul class="login-points">
                <li>Write and publish articles quickly</li>
                <li>Manage categories and users</li>
                <li>Track drafts and published content</li>
            </ul>
        </section>

        <section class="login-panel">
            <form action="{{ route('login.submit') }}" method="POST" class="card form-card">
                @csrf

                <div class="page-header">
                    <h1 class="page-title">Login</h1>
                    <p class="muted">Use your blogger credentials to continue.</p>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required>
                    @error('password')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Login</button>

                <p class="credentials-hint">
                    Demo account: <strong>blogger@blog.com</strong> / <strong>password</strong>
                </p>
            </form>
        </section>
    </div>
@endsection
