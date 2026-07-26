<div class="directory-listing">
    <a href="{{ $url }}" class="">
        <h2 class="text-lg font-bold">{{ $name }}</h2>
        <?php if(isset($description)): ?>
            <p class="tooltip mt-2 text-base-content/60">{{ $description }}</p>
        <?php else: ?>

        <?php endif; ?>
    </a>
</div>
