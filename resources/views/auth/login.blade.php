<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>To-Do List - Login</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/login.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-50 to-slate-100 dark:from-slate-900 dark:to-slate-800 p-4">
        <!-- Card -->
        <div class="w-full max-w-md rounded-lg border border-slate-200 bg-white text-slate-950 shadow-sm dark:border-slate-800 dark:bg-slate-950 dark:text-slate-50">
            <!-- Card Header -->
            <div class="flex flex-col space-y-1.5 p-6">
                <h3 class="text-2xl font-semibold leading-none tracking-tight text-center">Login</h3>
                {{-- <p class="text-sm text-slate-500 dark:text-slate-400 text-center">
                    Enter your email and password to sign in to your account
                </p> --}}
            </div>
            
            <!-- Card Content -->
            <div class="p-6 pt-0 space-y-4">
                <form method="POST" action="{{ route('login.post') }}" id="login-form" class="space-y-4">
                    @csrf
                    
                    <!-- Email Field -->
                    <div class="space-y-2">
                        <label for="email" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Email</label>
                        <div class="relative">
                            <!-- Mail Icon -->
                            <svg class="absolute left-3 top-3 h-4 w-4 text-slate-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="20" height="16" x="2" y="4" rx="2"/>
                                <path d="m22 7-10 5L2 7"/>
                            </svg>
                            <input
                                id="email"
                                name="email"
                                type="email"
                                placeholder="Enter your email"
                                value="{{ old('email') }}"
                                class="flex h-10 w-full rounded-md border border-slate-200 bg-white px-3 py-2 pl-10 text-sm ring-offset-white file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-slate-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-950 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-800 dark:bg-slate-950 dark:ring-offset-slate-950 dark:placeholder:text-slate-400 dark:focus-visible:ring-slate-300 @error('email') border-red-500 focus-visible:ring-red-500 @enderror"
                                required
                            />
                        </div>
                        @error('email')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="space-y-2">
                        <label for="password" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Password</label>
                        <div class="relative">
                            <!-- Lock Icon -->
                            <svg class="absolute left-3 top-3 h-4 w-4 text-slate-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                                <path d="m7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                placeholder="Enter your password"
                                class="flex h-10 w-full rounded-md border border-slate-200 bg-white px-3 py-2 pl-10 pr-10 text-sm ring-offset-white file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-slate-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-950 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-800 dark:bg-slate-950 dark:ring-offset-slate-950 dark:placeholder:text-slate-400 dark:focus-visible:ring-slate-300"
                                required
                            />
                            <!-- Password Toggle Button -->
                            <button
                                type="button"
                                id="password-toggle"
                                class="absolute right-3 top-3 h-4 w-4 text-slate-500 hover:text-slate-700"
                            >
                                <!-- Eye Icon (show password) -->
                                <svg id="eye-icon" class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                                <!-- Eye Off Icon (hide password) -->
                                <svg id="eye-off-icon" class="h-4 w-4" style="display: none;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M10.733 5.076a10.744 10.744 0 0 1 1.267-.074C17 5 20 9 20 12a4.169 4.169 0 0 1-.02.196m-1.182 1.182L15 15m-3 3c-5 0-8-4-8-7a13.134 13.134 0 0 1 1.551-2.76"/>
                                    <path d="M2 2 22 22"/>
                                    <path d="M15 9a3 3 0 1 1-6 6"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        id="submit-button"
                        class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-white transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-950 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 dark:ring-offset-slate-950 dark:focus-visible:ring-slate-300 bg-slate-900 text-slate-50 hover:bg-slate-900/90 dark:bg-slate-50 dark:text-slate-900 dark:hover:bg-slate-50/90 h-10 px-4 py-2 w-full"
                    >
                        <!-- Default Text -->
                        <span id="default-text">Sign in</span>
                        <!-- Loading Text -->
                        <div id="loading-text" class="flex items-center space-x-2" style="display: none;">
                            <div class="animate-spin h-4 w-4 border-2 border-current border-t-transparent rounded-full"></div>
                            <span>Signing in...</span>
                        </div>
                    </button>
                </form>

                {{-- <!-- Footer Text -->
                <div class="text-center text-sm text-slate-500">
                    Don't have an account?
                    <a href="#" class="font-medium text-slate-900 hover:underline dark:text-slate-50">
                        Contact administrator
                    </a>
                </div> --}}
            </div>
        </div>
    </div>
</body>
</html>