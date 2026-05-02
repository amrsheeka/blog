<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Inkwell</title>

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

        /* decorative circle */
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

        .panel-body { flex: 1; display: flex; flex-direction: column; justify-content: center; padding: 40px 0 20px; }

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
        }

        .panel-footer {
            font-size: 11px;
            color: rgba(255,255,255,0.2);
        }

        /* ── RIGHT FORM ── */
        .auth-form-wrap {
            flex: 1;
            padding: 52px 48px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-top {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 36px;
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
            margin-bottom: 32px;
        }

        /* Fields */
        .field-group { margin-bottom: 16px; }

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
            padding: 11px 16px;
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

        /* Remember + forgot row */
        .form-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            margin-top: 4px;
        }
        .check-wrap {
            display: flex;
            align-items: center;
            gap: 7px;
            cursor: pointer;
        }
        .check-wrap input[type="checkbox"] {
            width: 14px; height: 14px;
            accent-color: var(--accent);
            cursor: pointer;
        }
        .check-label {
            font-size: 12px;
            color: var(--text-muted);
            cursor: pointer;
        }
        .forgot-link {
            font-size: 12px;
            color: var(--text-muted);
            text-decoration: none;
            transition: color 0.15s;
        }
        .forgot-link:hover { color: var(--accent); }

        /* Submit button */
        .btn-submit {
            width: 100%;
            padding: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 500;
            border-radius: 10px;
            background: var(--text);
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background 0.15s;
            margin-bottom: 20px;
        }
        .btn-submit:hover { background: #2a2a28; }

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
                <h2 class="panel-heading">Welcome<br><em>back</em></h2>
                <p class="panel-sub">Sign in to continue managing your posts and sharing your ideas with the world.</p>
            </div>
            <div class="panel-footer">© {{ date('Y') }} Inkwell</div>
        </div>

        <!-- RIGHT FORM -->
        <div class="auth-form-wrap">

            <div class="form-top">
                <a href="{{ route('posts.index') }}" class="skip-link">Skip →</a>
            </div>

            <h1 class="form-heading">Sign in</h1>
            <p class="form-sub">Enter your credentials to access your account.</p>

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <!-- Email -->
                <div class="field-group">
                    <label class="field-label" for="email">Email</label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        class="field-input @error('email') is-invalid @enderror"
                        placeholder="you@example.com"
                        required
                    >
                    @error('email')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="field-group">
                    <label class="field-label" for="password">Password</label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        class="field-input @error('password') is-invalid @enderror"
                        placeholder="••••••••"
                        required
                    >
                    @error('password')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Remember + Forgot -->
                <div class="form-row">
                    <label class="check-wrap">
                        <input type="checkbox" id="remember" name="remember">
                        <span class="check-label">Remember me</span>
                    </label>
                    <a href="#" class="forgot-link">Forgot password?</a>
                </div>

                <button type="submit" class="btn-submit">Sign in</button>

                <p class="form-footer-text">
                    Don't have an account?
                    <a href="{{ route('register') }}">Create one</a>
                </p>

            </form>
        </div>

    </div>

</body>
</html>