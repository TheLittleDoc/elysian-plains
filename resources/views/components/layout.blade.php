<!DOCTYPE html>
<html lang="en">
<head>

    <title>{{ isset($title) ? $title . ' - Chirper' : 'Chirper' }}</title>


    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header>
        <!-- a three-panel flexbox containing the edition, the logo in the middle, and the date on the right -->
        <div class="flex items-center justify-between px-4 py-2">
            <div class="header-left text-balance text-base-content/60 flex-1/6">
                {{ $edition ?? 'Edition' }}
            </div>
            <div class="nameplate text-3xl font-bold text-center flex-2/3">
                Elysian Plains
            </div>
            <div class="header-right text-base-content/60 text-right flex-1/6 flex-wrap">
                {{ $date ?? now()->format('l, F j, Y') }}
            </div>
        </div>
        <nav class="flex flex-row-reverse gap-2 py-2">
            <a href="/login" class="text-base-content/60 hover:text-base-content">Login</a>
            <a href="/signup" class="text-base-content/60 hover:text-base-content">Sign Up</a>
        </nav>
    </header>
    <main class="flex content-center gap-4">
        <x-directory class="page-margin-column gap-4 px-4 py-2">

        </x-directory>
        <pageContent class="gap-4 px-4 py-2">
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
