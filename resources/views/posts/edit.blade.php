
<x-layout>
    @push('scripts')
        @vite('resources/js/editor.js')
    @endpush
    <script src="{{ asset('js/editor.js') }}"></script>
    <form method="POST" action="{{ route('posts.update', $post->id) }}" class="max-w-2xl mx-auto mt-8">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-bold mb-2">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" class="input input-bordered w-full @error('title') input-error @enderror" required>
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>


        <div class="mb-4">
            <label for="block_type" class="block text-gray-700 font-bold mb-2">Block Type</label>
            <select name="block_type" id="block_type" class="select select-bordered w-full @error('block_type') select-error @enderror">
                <option value="">Select a block type</option>
                <option value="text">Text</option>
                <option value="image">Image</option>
                <option value="heading">Heading</option>
            </select>
            <button type="button" id="add_block" class="btn btn-secondary mt-2" onclick="addBlock()">Add Block</button>
        </div>
        <div class="mb-4">
            <label for="content" class="block text-gray-700 font-bold mb-2">Content</label>
            <textarea name="content" id="content" rows="10" class="textarea textarea-bordered w-full @error('content') textarea-error @enderror" required>{{ old('content', $post->content) }}</textarea>
            @error('content')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="published" class="inline-flex items-center">
                <input type="checkbox" name="published" id="published" value="1" {{ old('published', $post->published) ? 'checked' : '' }} class="checkbox">
                <span class="ml-2">Published</span>
            </label>
        </div>
        <button type="button" class="btn btn-secondary mb-4" onclick="renderContent()">Render Content</button>
        <button type="submit" class="btn btn-primary">Update Post</button>
        <button type="button" class="btn btn-warning ml-2" onclick="if(confirm('Are you sure you want to discard your edits?')) { window.location.href='{{ route('home') }}' }">Cancel</button>
        <form action="{{ route('posts.destroy', $post['id']) }}" method="POST" class="inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-error mt-2" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>

        </form>
    </form>
    <div class="max-w-2xl mx-auto mt-8">
        <h2 class="text-2xl font-bold mb-4">Rendered Content Preview</h2>
        <div id="rendered_content" class="border p-4 rounded bg-gray-50">
            <!-- Rendered content will appear here -->
        </div>
    </div>
</x-layout>
