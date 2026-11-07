<x-layout>
    <x-slot:title>
        503 Service Unavailable
    </x-slot:title>
    <div class="max-w-4xl mx-automt-16">
        <h1 class="text-4xl font-bold mb-4">503 Service Unavailable</h1>
        <p class="text-lg mb-8">{{ $message ?? 'The service is currently unavailable. Please try again later.' }}</p>
        <a href="{{ route('home') }}" class="btn btn-primary">Go to Homepage</a>
    </div>
</x-layout>
