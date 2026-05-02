<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register — Inkwell</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --accent: #c2410c;
            --accent-light: #fde8dc;
            --bg: #f7f6f3;
            --surface: #ffffff;
            --border: rgba(0,0,0,0.08);
            --border-strong: rgba(0,0,0,0.14);
            --text: #111110;
            --text-muted: #6b6b68;
            --text-faint: #9c9c99;
        }

        html, body {
            height: 100%;
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 24px;
        }

        /* ── CARD ── */
        .auth-card {
            display: flex;
            width: 100%;
            max-width: 860px;
            background: var(--surface);
            border: 0.5px solid var(--border);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 40px rgba(0,0,0,0.07);
        }

        /* ── LEFT PANEL ── */
        .auth-panel {
            width: 42%;
            background: var(--text);
            padding: 52px 44px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
            flex-shrink: 0;
        }

        .auth-panel::before {
            content: '';
            position: absolute;
            width: 280px; height: 280px;
            border-radius: 50%;
            border: 0.5px solid rgba(255,255,255,0.06);
            bottom: -80px; right: -80px;
        }
        .auth-panel::after {
            content: '';
            position: absolute;
            width: 160px; height: 160px;
            border-radius: 50%;
            border: 0.5px solid rgba(255,255,255,0.06);
            top: -40px; left: -40px;
        }

        .panel-brand {
            font-family: 'Instrument Serif', serif;
            font-size: 18px;
            font-style: italic;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 7px;
            text-decoration: none;
        }
        .panel-brand .dot {
            width: 7px; height: 7px;
            background: var(--accent);
            border-radius: 50%;
        }

        .panel-body {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 40px 0 20px;
        }

        .panel-heading {
            font-family: 'Instrument Serif', serif;
            font-size: 34px;
            font-weight: 400;
            line-height: 1.15;
            color: #fff;
            margin-bottom: 14px;
        }
        .panel-heading em { font-style: italic; color: #f97316; }

        .panel-sub {
            font-size: 13px;
            color: rgba(255,255,255,0.45);
            line-height: 1.65;
            margin-bottom: 28px;
        }

        /* feature list */
        .panel-features { list-style: none; padding: 0; }
        .panel-features li {
            font-size: 12px;
            color: rgba(255,255,255,0.35);
            padding: 6px 0;
            display: flex;
            align-items: center;
            gap: 8px;
            border-top: 0.5px solid rgba(255,255,255,0.06);
        }
        .panel-features li:last-child { border-bottom: 0.5px solid rgba(255,255,255,0.06); }
        .feat-dot {
            width: 5px; height: 5px;
            border-radius: 50%;
            background: var(--accent);
            flex-shrink: 0;
        }

        .panel-footer {
            font-size: 11px;
            color: rgba(255,255,255,0.2);
        }

        /* ── RIGHT FORM ── */
        .auth-form-wrap {
            flex: 1;
            padding: 44px 48px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-top {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 28px;
        }
        .skip-link {
            font-size: 12px;
            color: var(--text-faint);
            text-decoration: none;
            transition: color 0.15s;
        }
        .skip-link:hover { color: var(--text-muted); }

        .form-heading {
            font-family: 'Instrument Serif', serif;
            font-size: 30px;
            font-weight: 400;
            margin-bottom: 6px;
        }
        .form-sub {
            font-size: 13px;
            color: var(--text-muted);
            margin-bottom: 28px;
        }

        /* Fields */
        .field-group { margin-bottom: 14px; }

        .field-label {
            display: block;
            font-size: 11px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.09em;
            color: var(--text-muted);
            margin-bottom: 7px;
        }

        .field-input {
            width: 100%;
            padding: 10px 16px;
            font-size: 14px;
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            border: 0.5px solid var(--border-strong);
            border-radius: 10px;
            color: var(--text);
            outline: none;
            transition: border-color 0.15s, box-shadow 0.15s, background 0.15s;
        }
        .field-input::placeholder { color: var(--text-faint); }
        .field-input:focus {
            background: var(--surface);
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(194, 65, 12, 0.08);
        }
        .field-input.is-invalid {
            border-color: #f87171;
            box-shadow: 0 0 0 3px rgba(248, 113, 113, 0.1);
        }

        .field-error {
            font-size: 12px;
            color: #dc2626;
            margin-top: 5px;
        }

        /* two-column row */
        .fields-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        /* Submit button */
        .btn-submit {
            width: 100%;
            padding: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 500;
            border-radius: 10px;
            background: var(--accent);
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background 0.15s;
            margin-top: 20px;
            margin-bottom: 18px;
        }
        .btn-submit:hover { background: #a83609; }

        .form-footer-text {
            text-align: center;
            font-size: 13px;
            color: var(--text-muted);
        }
        .form-footer-text a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
        }
        .form-footer-text a:hover { text-decoration: underline; }

        /* Responsive */
        @media (max-width: 640px) {
            .auth-panel { display: none; }
            .auth-form-wrap { padding: 40px 28px; }
            .fields-row { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <div class="auth-card">

        <!-- LEFT PANEL -->
        <div class="auth-panel">
            <a href="{{ route('posts.index') }}" class="panel-brand">
                <span class="dot"></span> Inkwell
            </a>
            <div class="panel-body">
                <h2 class="panel-heading">Start<br><em>writing</em></h2>
                <p class="panel-sub">Create your account and share your thoughts with readers around the world.</p>
                <ul class="panel-features">
                    <li><span class="feat-dot"></span> Write and publish posts</li>
                    <li><span class="feat-dot"></span> Edit and manage your content</li>
                    <li><span class="feat-dot"></span> Reach a growing community</li>
                </ul>
            </div>
            <div class="panel-footer">© {{ date('Y') }} Inkwell</div>
        </div>

        <!-- RIGHT FORM -->
        <div class="auth-form-wrap">

            <div class="form-top">
                <a href="{{ route('posts.index') }}" class="skip-link">Skip →</a>
            </div>

            <h1 class="form-heading">Create account</h1>
            <p class="form-sub">Fill in your details to get started.</p>

            <form action="{{ route('register.store') }}" method="POST">
                @csrf

                <!-- Name -->
                <div class="field-group">
                    <label class="field-label" for="name">Full name</label>
                    <input
                        id="name"
                        name="name"
                        type="text"
                        class="field-input @error('name') is-invalid @enderror"
                        placeholder="Your full name"
                        value="{{ old('name') }}"
                        autofocus
                    >
                    @error('name')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="field-group">
                    <label class="field-label" for="email">Email</label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        class="field-input @error('email') is-invalid @enderror"
                        placeholder="you@example.com"
                        value="{{ old('email') }}"
                    >
                    @error('email')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password row -->
                <div class="fields-row">
                    <div class="field-group">
                        <label class="field-label" for="password">Password</label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            class="field-input @error('password') is-invalid @enderror"
                            placeholder="••••••••"
                        >
                        @error('password')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field-group">
                        <label class="field-label" for="password_confirmation">Confirm</label>
                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            class="field-input"
                            placeholder="••••••••"
                        >
                    </div>
                </div>

                <button type="submit" class="btn-submit">Create account</button>

                <p class="form-footer-text">
                    Already have an account?
                    <a href="{{ route('login') }}">Sign in</a>
                </p>

            </form>
        </div>

    </div>

</body>
</html>