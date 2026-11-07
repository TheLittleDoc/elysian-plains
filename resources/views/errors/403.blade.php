<x-layout>
    <x-slot:title>
        403 Forbidden
    </x-slot:title>
    <div class="max-w-4xl mx-automt-16">
        <h1 class="text-4xl font-bold mb-4">403 Forbidden</h1>
        <p class="text-lg mb-8">{{ $message ?? 'You are not authorized to access the requested page' }}</p>
        <a href="{{ route('home') }}" class="btn btn-primary">Go to Homepage</a>
    </div>
</x-layout>
