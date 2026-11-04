
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
        <x-pubpost :post='$post'></x-pubpost>
    @endforeach
</x-layout>
