<div class="directory-listing">
    @if(isset($method))
        <form action="{{ $url }}" method="{{ $method }}" class="inline-block">
            @csrf
            <button type="submit" class="btn-a">
                <h2 class="text-lg font-bold">{{ $name }}</h2>
                @if(isset($description))
                    <p class="tooltip mt-2 text-base-content/60">{{ $description }}</p>
                @else

                @endif
            </button>
        </form>
    @else
        <a href="{{ $url }}" class="directory-listing-a">
            <h2 class="text-lg font-bold">{{ $name }}</h2>
            @if(isset($description))
                <p class="tooltip mt-2 text-base-content/60">{{ $description }}</p>
            @else

            @endif
        </a>
    @endif
</div>
