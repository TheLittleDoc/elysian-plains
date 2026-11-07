<x-layout>
    <x-slot:title>
        429 Too Many Requests
    </x-slot:title>
    <div class="max-w-4xl mx-automt-16">
        <h1 class="text-4xl font-bold mb-4">429 Too Many Requests</h1>
        <p class="text-lg mb-8">{{ $message ?? 'Too many requests. Please try again later.' }}</p>
        <a href="{{ route('home') }}" class="btn btn-primary">Go to Homepage</a>
    </div>
</x-layout>
