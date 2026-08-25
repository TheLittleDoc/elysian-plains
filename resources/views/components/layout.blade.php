<?php
$entries = [
    [
        'url' => '/',
        'name' => 'Home',
        'description' => 'View the home page',
        'auth' => 0
    ],
    [
        'url' => '/login',
        'name' => 'Login',
        'description' => 'Login to your account',
        'auth' => -1
    ],
    [
        'url' => '/register',
        'name' => 'Register',
        'description' => 'Create a new account',
        'auth' => -1
    ],
    [
        'url' => '/profile',
        'name' => 'Profile',
        'description' => 'View your profile',
        'auth' => 1
    ],
    [
        'url' => '/posts',
        'method' => 'POST',
        'name' => 'Create Post',
        'description' => 'Create a new post',
        'auth' => 2
    ],
    [
        'url' => '/posts',
        'name' => 'Posts',
        'description' => 'View all posts',
        'auth' => 0
    ],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>{{ isset($title) ? $title . ' - Elysian Plains' : 'Elysian Plains' }}</title>


    @vite(array_merge([
        'resources/js/app.js',
        'resources/css/app.css',
    ], $additonalAssets ?? []))
    @stack('scripts')
</head>
<body>
<header>
    <!-- a three-panel flexbox containing the edition, the logo in the middle, and the date on the right -->
    <div class="flex items-center justify-between px-4 py-2">
        <div class="header-left text-balance text-base-content/60 flex-1/6">
            <p>{{ 'Volume ' . App\Models\Post::getVolume() }}</p>
            <p>{{ 'Issue ' . App\Models\Post::getIssue() }}</p>
        </div>
        <img src="{{ asset('elysian-plains-logo.svg') }}" alt="Elysian Plains Logo" class="inline-block" width="200" height="50">
        <div class="header-right text-base-content/60 text-right flex-1/6 flex-wrap">
            <p>{{ $date ?? now()->format('l, F j, Y') }}</p>
            @auth
                <span class="text-sm">{{ auth()->user()->name }}</span>
                <form method="POST" action="/logout" class="inline">
                    @csrf
                    <button type="submit" class="btn-auth">Logout</button>
                </form>
            @else
                <a href="/login" class="btn-auth text-base-content/60 hover:text-base-content">Login</a>
                <a href="{{ route('register') }}" class="btn-auth text-base-content/60 hover:text-base-content">Sign Up</a>
            @endauth
        </div>

    </div>

    <nav class="flex flex-row-reverse gap-2 py-2">

    </nav>
</header>
<main class="flex content-center gap-4">
    <x-directory class="page-margin-column gap-4 px-4 py-2" :entries="$entries" :directoryHeading="$directoryHeading ?? 'Directory'">

    </x-directory>
    <pageContent class="">
        {{ $slot }}
    </pageContent>
    <gallery class="page-margin-column column-right gap-4 px-4 py-2">
        <h2 class="text-lg font-bold">
            {{ 'Calendar' }}
        </h2>
    </gallery>
</main>
</body>
</html>
