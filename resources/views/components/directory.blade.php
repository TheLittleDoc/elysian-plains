<directory class="column-left page-margin-column flex gap-4 px-4 py-2">
    <h2 class="text-lg font-bold column-heading">
        {{ $directoryHeading ?? 'Directory' }}
    </h2>
    <h2>
        @foreach ($entries as $entry)
        <x-directorylisting>
            <x-slot:name>{{ $entry['name'] }}</x-slot:name>
            @if (isset($entry['description']))
                <x-slot:description>{{ $entry['description'] }}</x-slot:description>
            @endif
            <x-slot:url>{{ $entry['url'] }}</x-slot:url>
        </x-directorylisting>
        @endforeach
    </h2>


</directory>
