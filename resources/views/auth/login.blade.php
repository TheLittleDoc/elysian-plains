<x-layout>
    <x-slot:title>
        Sign In
    </x-slot:title>

        <h1 class="text-3xl font-bold text-center mb-6">Welcome Back</h1>

        <form method="POST" action="/login">
            @csrf
            <!-- Flexbox grid, shrink, centered -->
            <div class="form-container">
            <div class="grid grid-cols-2 shrink min-w-0">
                <div>
                    <!-- Email -->
                    <label class="floating-label mb-6">
                        <span>Email</span>
                    </label>
                </div>
                <div>
            <input type="email"
                   name="email"
                   placeholder="you@example.org"
                   value="{{ old('email') }}"
                   class="input input-bordered @error('email') input-error @enderror"
                   required
                   autofocus>
            @error('email')
            <div class="label -mt-4 mb-2">
                <span class="label-text-alt text-error">{{ $message }}</span>
            </div>
            @enderror
                </div>
            <!-- Password -->
                <div>
            <label class="floating-label mb-6">
                <span>Password</span>
            </label>
                </div>
                <div>
                <input type="password"
                       name="password"
                       placeholder="••••••••"
                       class="input input-bordered @error('password') input-error @enderror"
                       required>
            @error('password')
            <div class="label -mt-4 mb-2">
                <span class="label-text-alt text-error">{{ $message }}</span>
            </div>
            @enderror
            </div>
            </div>
            <!-- Remember Me -->
            <div class="form-control mt-4">
                <label class="label cursor-pointer justify-start">
                    <input type="checkbox"
                           name="remember"
                           class="checkbox">
                    <span class="label-text ml-2">Remember me</span>
                </label>
            </div>

            <!-- Submit Button -->
            <div class="form-control mt-8">
                <button type="submit" class="btn btn-primary btn-sm w-full">
                    Sign In
                </button>
            </div>
            </div>
        </form>

        <p class="text-center text-sm">
            Don't have an account?
            <a href="/register" class="link link-primary">Register</a>
        </p>
</x-layout>
