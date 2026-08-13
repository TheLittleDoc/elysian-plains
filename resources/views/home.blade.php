
<x-layout>
    <x-slot:title>
        Welcome
    </x-slot:title>
    <x-slot:directoryHeading>
        Directory
    </x-slot:directoryHeading>
    <x-slot:galleryHeading>
        Calendar
    </x-slot:galleryHeading>
    <div class="max-w-4xl mx-auto">
        @foreach ($posts as $post)
            <x-renderer :post='$post'></x-renderer>
        @endforeach
    </div>
</x-layout>
