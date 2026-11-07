<x-layout>
    <x-slot:title>
        419 Page Expired
    </x-slot:title>
    <div class="max-w-4xl mx-automt-16">
        <h1 class="text-4xl font-bold mb-4">419 Page Expired</h1>
        <p class="text-lg mb-8">{{ $message ?? 'The page you are looking for has expired.' }}</p>
        <a href="{{ route('home') }}" class="btn btn-primary">Go to Homepage</a>
    </div>
</x-layout>
