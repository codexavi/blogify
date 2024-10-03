<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            body {
                font-family: 'Nunito', sans-serif;
                margin: 0;
                padding: 0;
                color: #f8fafc;
                background-color: #111;
                overflow: hidden;
                height: 100vh;
                position: relative;
            }

            /* Darker animated gradient background with deep colors including dark red, blue, and dark yellow */
            .animated-background {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(270deg, #0d0d0d, #1a1a1a, #181818, #1e1e24, #0b0f30, #2a0a0a, #222222, #3e2a2a, #001f3f, #4d4d00);
                background-size: 1000% 1000%;
                animation: gradientBackground 18s ease infinite;
                z-index: -1;
            }

            @keyframes gradientBackground {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }

            .welcome-container {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                flex-direction: column;
                z-index: 1;
            }

            .content {
                text-align: center;
            }

            /* Larger Animated App Name */
            .title {
                font-size: 120px;
                font-weight: 800;
                margin-bottom: 30px;
                color: #ffffff;
                letter-spacing: 2px;
                background-image: linear-gradient(45deg, #ff416c, #ff4b2b);
                -webkit-background-clip: text;
                color: transparent;
                animation: glow 2s infinite;
            }

            /* Glow effect for the title */
            @keyframes glow {
                0% {
                    text-shadow: 0 0 10px #ff4b2b, 0 0 20px #ff416c, 0 0 30px #ff4b2b;
                }
                50% {
                    text-shadow: 0 0 20px #ff4b2b, 0 0 30px #ff416c, 0 0 40px #ff4b2b;
                }
                100% {
                    text-shadow: 0 0 10px #ff4b2b, 0 0 20px #ff416c, 0 0 30px #ff4b2b;
                }
            }

            .description {
                font-size: 20px;
                margin-bottom: 40px;
                max-width: 600px;
                line-height: 1.6;
                color: #f8fafc;
                animation: fadeIn 2.5s ease-out;
            }

            /* Button styling with animation */
            .links > a {
                display: inline-block;
                background-color: #ff416c;
                color: white;
                padding: 14px 30px;
                font-size: 16px;
                font-weight: 700;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                border-radius: 8px;
                transition: background-color 0.5s ease, transform 0.3s;
                margin: 10px;
                animation: fadeIn 3s ease-out;
            }

            .links > a:hover {
                background-color: #ff4b2b;
                transform: scale(1.2);
                box-shadow: 0px 4px 20px rgba(255, 75, 43, 0.5);
            }

            /* Fade-in animation for description and buttons */
            @keyframes fadeIn {
                from {
                    opacity: 0;
                }
                to {
                    opacity: 1;
                }
            }

            footer {
                position: fixed;
                bottom: 10px;
                width: 100%;
                text-align: center;
                font-size: 12px;
                color: #cccccc;
                z-index: 1;
            }

        </style>
    </head>
    <body>
        <!-- Darker Animated Background with dark red, blue, and dark yellow -->
        <div class="animated-background"></div>

        <div class="welcome-container">
            <div class="content">
                <!-- Large Animated App Name -->
                <div class="title m-b-md">
                    {{ config('app.name', 'Laravel') }}
                </div>

                <!-- Portal description -->
                <div class="description">
                    Welcome to {{ config('app.name', 'Laravel') }}! Your ultimate platform for managing content and users. Explore our features and experience a modern system for your needs.
                </div>

                <!-- Login and Register Buttons -->
                <div class="links">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>

        <!-- Footer with Copyright -->
        <footer>
            &copy; {{ now()->year }} {{ config('app.name', 'Laravel') }}. All rights reserved.
        </footer>
    </body>
</html>
