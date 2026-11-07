<x-layout>
    <x-slot:title>
        500 Server Error
    </x-slot:title>
    <div class="max-w-4xl mx-automt-16">
        <h1 class="text-4xl font-bold mb-4">500 Server Error</h1>
        <p class="text-lg mb-8">{{ $message ?? 'An internal error occurred. Please contact site webmaster.' }}</p>
        <a href="{{ route('home') }}" class="btn btn-primary">Go to Homepage</a>
    </div>
</x-layout>
