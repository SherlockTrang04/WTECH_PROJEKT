<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin – Prihlásenie</title>

    {{-- Bootstrap --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    {{-- Your global stylesheet (adjust path as needed) --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        /* ── BOOTSTRAP OVERRIDES ─────────────────────── */
        .form-control {
            background-color: rgba(255, 255, 255, 0.08);
            border: 1px solid var(--border-light);
            border-radius: 8px;
            color: var(--text-light);
            font-family: "Nunito", sans-serif;
            padding: 0.85rem 0.9rem;
        }

        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.08);
            border-color: var(--text-light);
            box-shadow: 0 0 0 3px rgba(242, 241, 241, 0.2);
            color: var(--text-light);
        }

        .form-control::placeholder {
            color: rgba(242, 241, 241, 0.35);
        }

        .form-label {
            color: var(--text-light);
            font-weight: 600;
            font-size: 0.9rem;
            font-family: "Nunito", sans-serif;
        }

        .btn-primary {
            background-color: var(--text-light);
            border-color: var(--text-light);
            color: var(--bg-dark);
            font-family: "Nunito", sans-serif;
            font-weight: 700;
            padding: 0.9rem;
            border-radius: 7px;
            transition: all 0.2s ease;
        }

        .btn-primary:hover,
        .btn-primary:active,
        .btn-primary:focus {
            background-color: var(--bg-dark-light);
            border-color: var(--bg-dark-light);
            color: var(--text-light);
            box-shadow: none;
            transform: translateY(-1px);
        }

        .alert-danger {
            background-color: rgba(255, 107, 107, 0.12);
            border: 1px solid rgba(255, 107, 107, 0.35);
            color: #ff6b6b;
            border-radius: 8px;
            font-size: 0.88rem;
            font-family: "Nunito", sans-serif;
        }

        /* ── PAGE LAYOUT ─────────────────────────────── */
        .admin-login-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--bg-dark);
        }

        .admin-login-card {
            width: min(460px, 90vw);
            background-color: rgba(25, 4, 66, 0.85);
            border: 1px solid rgba(242, 241, 241, 0.2);
            border-radius: 16px;
            box-shadow: 0 0 20px #c1b8b8;
            backdrop-filter: blur(6px);
            padding: 2.3rem;
        }

        .admin-login-card h1 {
            color: var(--text-light);
            font-size: 1.7rem;
            font-weight: 800;
            text-align: center;
            margin-bottom: 0.4rem;
            background-color: transparent;
        }

        .admin-login-card .subtitle {
            text-align: center;
            color: rgba(242, 241, 241, 0.45);
            font-size: 0.82rem;
            margin-bottom: 1.8rem;
            background-color: transparent;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 1.1rem;
            color: rgba(242, 241, 241, 0.6);
            font-size: 0.88rem;
            text-decoration: none;
            transition: color 0.2s;
            background-color: transparent;
        }

        .back-link:hover {
            color: var(--text-light);
            text-decoration: underline;
        }
    </style>
</head>

<body>
<div class="admin-login-page">
    <div class="admin-login-card">

        <h1>Admin</h1>
        <p class="subtitle">Prihláste sa do administrácie</p>

        {{-- Session error --}}
        @if (session('error'))
            <div class="alert alert-danger mb-3" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin-login') }}">
            @csrf

            {{-- Email --}}
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-control @error('email') is-invalid @enderror"
                    placeholder="admin@elektroshop.sk"
                    value="{{ old('email') }}"
                    autocomplete="email"
                    required
                    autofocus
                >
                @error('email')
                    <div class="invalid-feedback" style="color:#ff6b6b; font-size:0.8rem;">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <label for="password" class="form-label">Heslo</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control @error('password') is-invalid @enderror"
                    autocomplete="current-password"
                    required
                >
                @error('password')
                    <div class="invalid-feedback" style="color:#ff6b6b; font-size:0.8rem;">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">
                Prihlásiť sa
            </button>
        </form>

        <a href="{{ route('home') }}" class="back-link">← Späť na hlavnú stránku</a>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>