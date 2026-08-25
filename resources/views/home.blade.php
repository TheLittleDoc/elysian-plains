
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
    @foreach ($posts as $post)
        <x-renderer :post='$post'></x-renderer>
    @endforeach
</x-layout>
