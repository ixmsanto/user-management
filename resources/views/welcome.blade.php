
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User-Management Application</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Inline Animations -->
    <style>
        /* Fade-in and slide-up animation for main content */
        .animate-main {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeSlideUp 0.75s ease-out forwards;
        }

        /* Button hover animation */
        .btn-animate {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-animate:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        /* Logo animation */
        .logo-animate {
            opacity: 0;
            transform: scale(0.9);
            animation: fadeScaleIn 1s ease-out 0.3s forwards;
        }

        @keyframes fadeSlideUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeScaleIn {
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Gradient background for dark mode */
        .dark .bg-dark-gradient {
            background: linear-gradient(135deg, #1a1a1a 0%, #0a0a0a 100%);
        }

        /* Custom card shadow */
        .custom-card {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1), inset 0 0 0 1px rgba(26, 26, 0, 0.1);
        }

        .dark .custom-card {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2), inset 0 0 0 1px rgba(255, 250, 237, 0.18);
        }
    </style>
</head>
<body class="bg-light dark:bg-dark-gradient text-dark flex p-4 lg:p-6 items-center justify-center min-h-screen flex-col font-sans">
    <header class="w-full max-w-4xl text-sm mb-4">
        @if (Route::has('login'))
            <nav class="flex items-center justify-end gap-3">
                @auth
                    <a href="{{ url('/dashboard') }}"
                       class="btn btn-outline-dark btn-sm btn-animate dark:text-light dark:border-light/50 hover:bg-dark hover:text-white dark:hover:bg-white dark:hover:text-dark"
                       aria-label="Go to Dashboard">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="btn btn-link btn-sm btn-animate text-dark dark:text-light hover:text-primary dark:hover:text-primary"
                       aria-label="Log in to your account">
                        Log in
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="btn btn-outline-dark btn-sm btn-animate dark:text-light dark:border-light/50 hover:bg-dark hover:text-white dark:hover:bg-white dark:hover:text-dark"
                           aria-label="Register a new account">
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    <div class="flex items-center justify-center w-full animate-main">
        <main class="flex max-w-4xl w-full flex-col-reverse lg:flex-row gap-4">
            <section class="flex-1 p-6 lg:p-8 bg-white dark:bg-dark custom-card rounded-lg text-dark dark:text-light">
                <h1 class="h3 mb-2 font-semibold">Welcome to User-Management Application</h1>
                <p class="text-muted mb-4 dark:text-light/70">
                    Manage your users efficiently with our powerful and intuitive platform.
                </p>
                @auth
                    <a href="{{ url('/dashboard') }}"
                       class="btn btn-primary btn-sm btn-animate"
                       aria-label="Go to Dashboard">
                        Get Started
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="btn btn-primary btn-sm btn-animate"
                       aria-label="Log in to start">
                        Get Started
                    </a>
                @endauth
            </section>
        </main>
    </div>
</body>
</html>
