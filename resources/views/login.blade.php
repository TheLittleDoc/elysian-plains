<x-layout>
    <x-slot:title>
        Welcome
    </x-slot:title>
    <div class="max-w-2xl mx-auto">
        <div class="card bg-base-100 shadow mt-8">
            <div class="card-body">
                <div>
                    <h1 class="text-3xl font-bold">Sign in</h1>
                    <form>
                        <input type="text" placeholder="Username" class="input input-bordered w-full mt-4" />
                        <input type="password" placeholder="Password" class="input input-bordered w-full mt-4" />
                        <button type="submit" class="btn btn-primary w-full mt-4">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
