<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inkwell — My Blog</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet">

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        :root {
            --accent: #c2410c;
            --accent-light: #fde8dc;
            --accent-mid: #fca882;
            --bg: #f7f6f3;
            --surface: #ffffff;
            --border: rgba(0, 0, 0, 0.08);
            --border-strong: rgba(0, 0, 0, 0.14);
            --text: #111110;
            --text-muted: #6b6b68;
            --text-faint: #9c9c99;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            font-size: 15px;
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── NAVBAR ── */
        .site-nav {
            height: 56px;
            background: var(--surface);
            border-bottom: 0.5px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-brand {
            font-family: 'Instrument Serif', serif;
            font-size: 20px;
            font-style: italic;
            color: var(--text);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .nav-brand .dot {
            width: 7px;
            height: 7px;
            background: var(--accent);
            border-radius: 50%;
            display: inline-block;
            margin-bottom: 2px;
        }

        .nav-brand:hover {
            color: var(--text);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-nav {
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 400;
            padding: 6px 18px;
            border-radius: 999px;
            border: 0.5px solid var(--border-strong);
            background: transparent;
            color: var(--text-muted);
            cursor: pointer;
            text-decoration: none;
            transition: background 0.15s, color 0.15s;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-nav:hover {
            background: var(--bg);
            color: var(--text);
        }

        .btn-nav-filled {
            background: var(--text);
            color: #fff !important;
            border-color: var(--text);
        }

        .btn-nav-filled:hover {
            background: #333;
        }

        .btn-nav-accent {
            background: var(--accent);
            color: #fff !important;
            border-color: var(--accent);
        }

        .btn-nav-accent:hover {
            background: #a83609;
        }

        /* ── ALERTS ── */
        .flash-alert {
            max-width: 820px;
            margin: 20px auto 0;
            padding: 12px 18px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .flash-success {
            background: #f0fdf4;
            color: #166534;
            border: 0.5px solid #bbf7d0;
        }

        .flash-danger {
            background: #fff5f5;
            color: #991b1b;
            border: 0.5px solid #fecaca;
        }

        /* ── FOOTER ── */
        .site-footer {
            margin-top: auto;
            border-top: 0.5px solid var(--border);
            padding: 24px 32px;
            text-align: center;
            font-size: 12px;
            color: var(--text-faint);
        }

        /* ── MAIN CONTENT ── */
        .site-main {
            flex: 1;
        }

        /* ── SHARED BUTTON STYLES ── */
        .btn-primary-custom {
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 500;
            padding: 9px 26px;
            border-radius: 999px;
            background: var(--text);
            color: #fff;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: background 0.15s;
        }

        .btn-primary-custom:hover {
            background: #333;
            color: #fff;
        }

        .btn-accent-custom {
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 500;
            padding: 9px 26px;
            border-radius: 999px;
            background: var(--accent);
            color: #fff;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: background 0.15s;
        }

        .btn-accent-custom:hover {
            background: #a83609;
            color: #fff;
        }

        .btn-ghost-custom {
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 400;
            padding: 9px 24px;
            border-radius: 999px;
            background: transparent;
            color: var(--text-muted);
            border: 0.5px solid var(--border-strong);
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: background 0.15s, color 0.15s;
        }

        .btn-ghost-custom:hover {
            background: var(--surface);
            color: var(--text);
        }

        .btn-danger-custom {
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 400;
            padding: 9px 24px;
            border-radius: 999px;
            background: transparent;
            color: var(--accent);
            border: 0.5px solid #fca5a5;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: background 0.15s;
        }

        .btn-danger-custom:hover {
            background: #fff5f5;
        }

        /* ── AVATAR ── */
        .user-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: var(--accent-light);
            color: var(--accent);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 500;
            flex-shrink: 0;
        }

        .user-avatar-lg {
            width: 42px;
            height: 42px;
            font-size: 16px;
        }

        /* ── POST CARD ── */
        .post-card {
            background: var(--surface);
            border: 0.5px solid var(--border);
            border-radius: 14px;
            padding: 22px;
            display: flex;
            flex-direction: column;
            text-decoration: none;
            color: inherit;
            transition: border-color 0.15s, transform 0.15s;
            height: 100%;
        }

        .post-card:hover {
            border-color: var(--border-strong);
            transform: translateY(-2px);
            color: inherit;
        }

        .post-card-author {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 14px;
        }

        .post-card-author-name {
            font-size: 12px;
            color: var(--text-muted);
        }

        .post-card-title {
            font-size: 15px;
            font-weight: 500;
            line-height: 1.45;
            margin-bottom: 8px;
            color: var(--text);
        }

        .post-card-excerpt {
            font-size: 13px;
            color: var(--text-muted);
            line-height: 1.6;
            flex: 1;
            margin-bottom: 16px;
        }

        .post-card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: auto;
        }

        .post-card-date {
            font-size: 11px;
            color: var(--text-faint);
        }

        .post-card-read {
            font-size: 12px;
            font-weight: 500;
            color: var(--accent);
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="site-nav">
        <a class="nav-brand" href="{{ route('home') }}">
            <span class="dot"></span> Inkwell
        </a>

        <div class="nav-actions">
            <a href="{{ route('posts.index') }}" class="btn-nav">
                All Posts
            </a>
            @auth
            <a href="{{ route('posts.create') }}" class="btn-nav btn-nav-accent">
                + New post
            </a>

            <!-- Profile Button -->
            <a href="{{ route('profile') }}" class="btn-nav">
                <span class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </span>
                Profile
            </a>

            <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                @csrf
                <button type="submit" class="btn-nav">Logout</button>
            </form>
            @endauth

            @guest
            <a href="{{ route('login') }}" class="btn-nav">Login</a>
            <a href="{{ route('register') }}" class="btn-nav btn-nav-filled">Register</a>
            @endguest
        </div>
    </nav>

    <!-- FLASH MESSAGES -->
    @if (session('success'))
    <div style="max-width: 860px; margin: 20px auto 0; padding: 0 32px;">
        <div class="flash-alert flash-success">
            <span>✓</span> {{ session('success') }}
        </div>
    </div>
    @endif

    @if (session('failed'))
    <div style="max-width: 860px; margin: 20px auto 0; padding: 0 32px;">
        <div class="flash-alert flash-danger">
            <span>✕</span> {{ session('failed') }}
        </div>
    </div>
    @endif

    <!-- CONTENT -->
    <main class="site-main">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="site-footer">
        © {{ date('Y') }} Inkwell &mdash; All rights reserved
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>