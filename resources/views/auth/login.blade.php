@extends('layouts.app')

@section('title', 'Log In')

@section('body_class', 'auth-page')

@section('head_js')
    @vite('resources/js/login/login.js')
@endsection

@section('content')
    <!-- Log In -->
    <main class="login-container">
        <aside class="demo-credentials-popup" role="note" aria-live="polite">
            <div class="demo-credentials-header">
                <span>Demo credentials</span>
                <button type="button" class="demo-credentials-close" aria-label="Dismiss demo credentials">
                    &times;
                </button>
            </div>
            <div class="demo-credentials-body">
                <button type="button" class="demo-credentials-row" data-username="admin">
                    <div class="demo-credentials-role">Admin</div>
                    <div class="demo-credentials-details">
                        <div><span class="demo-credentials-label">Username</span> <code>admin</code></div>
                        <div><span class="demo-credentials-label">Password</span> <span>Ask the team for access</span></div>
                    </div>
                </button>
                <button type="button" class="demo-credentials-row" data-username="MarioR">
                    <div class="demo-credentials-role">User</div>
                    <div class="demo-credentials-details">
                        <div><span class="demo-credentials-label">Username</span> <code>MarioR</code></div>
                        <div><span class="demo-credentials-label">Password</span> <span>Ask the team for access</span></div>
                    </div>
                </button>
            </div>
            <div class="demo-credentials-hint">Click a profile to auto-fill the login form.</div>
        </aside>

        <section class="login-card" aria-labelledby="loginTitle">
            <div class="text">
                🌋 Log In
            </div>

            @if (session('status'))
                <div class="alert alert-success" role="status" aria-live="polite">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Validation errors --}}
            @if ($errors->any())
                <div class="alert alert-danger auth-error" role="alert">
                    <i class="fas fa-exclamation-circle"></i>
                    <div>
                        <strong>Please fix the following errors:</strong>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('login.perform') }}" method="POST" novalidate class="login-form">
                @csrf

                <div class="login-data">
                    <label for="username">
                        <i class="fas fa-user"></i>
                        Username
                    </label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        value="{{ old('username') }}"
                        required
                        autocomplete="username"
                        placeholder="Enter your username"
                        class="form-input"
                    >
                </div>

                <div class="login-data">
                    <label for="password">
                        <i class="fas fa-lock"></i>
                        Password
                    </label>
                    <div class="password-field">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="Enter your password"
                            class="form-input"
                        >
                        <button type="button" class="password-toggle" data-target="password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="loginpage-btn">
                    <button type="submit" class="login-submit-btn">
                        <span class="btn-text">Log In</span>
                        <span class="btn-loader">
                            <i class="fas fa-spinner fa-spin"></i>
                        </span>
                    </button>
                </div>

                <div class="signup-link">
                    <span>Forgot your password?</span>
                    <a href="{{ route('password.reset.show') }}" class="login-anchor">
                        <strong>Reset it</strong>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <div class="signup-link">
                    <span>Not a member yet?</span>
                    <a href="{{ route('register.show') }}" class="signup-anchor">
                        <strong>Sign Up Now</strong>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </form>
        </section>
    </main>

    <script>
        // Fomr
        document.querySelector('.login-form').addEventListener('submit', function() {
            const btn = this.querySelector('.login-submit-btn');
            btn.classList.add('loading');
            btn.disabled = true;
        });

        // password visibility
        document.querySelectorAll('.password-toggle').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.dataset.target;
                const input = document.getElementById(targetId);
                const icon = this.querySelector('i');
                
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                    this.setAttribute('aria-label', 'Hide password');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                    this.setAttribute('aria-label', 'Show password');
                }
            });
        });

        // demo credentials popup
        const demoPopup = document.querySelector('.demo-credentials-popup');
        const demoClose = document.querySelector('.demo-credentials-close');
        if (demoPopup && demoClose) {
            demoClose.addEventListener('click', () => {
                demoPopup.classList.add('is-hidden');
            });
        }

        document.querySelectorAll('.demo-credentials-row').forEach((row) => {
            row.addEventListener('click', () => {
                const username = row.dataset.username;
                const usernameInput = document.getElementById('username');
                const passwordInput = document.getElementById('password');

                if (usernameInput) {
                    usernameInput.value = username;
                    usernameInput.dispatchEvent(new Event('input', { bubbles: true }));
                }

                if (passwordInput) {
                    passwordInput.focus();
                }
            });
        });
    </script>
@endsection
