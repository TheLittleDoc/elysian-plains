<directory class="column-left page-margin-column flex gap-4 px-4 py-2">
    <h2 class="text-lg font-bold column-heading">
        {{ $directoryHeading ?? 'Directory' }}
    </h2>
    <h2>
        <x-directorylisting>
            <x-slot:name>Blog</x-slot:name>
            <x-slot:url>posts.php</x-slot:url>
        </x-directorylisting>
        <x-directorylisting>
            <x-slot:name>Login</x-slot:name>
            <x-slot:description>Log in to comment and like</x-slot:description>
            <x-slot:url>login</x-slot:url>
        </x-directorylisting>
    </h2>


</directory>
