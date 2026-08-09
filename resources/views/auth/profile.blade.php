<x-layout>
    <x-slot:title>
        Update Profile
    </x-slot:title>

    <div class="hero min-h-[calc(100vh-16rem)]">
        <div class="hero-content flex-col">
            <div class="card w-96 bg-base-100">
                <div class="card-body">
                    <h1 class="text-3xl font-bold text-center mb-6">Update your profile</h1>

                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf

                        <!-- Name -->
                        <label class="floating-label mb-6">
                            <span>Change Name</span>
                            <input type="text"
                                   name="name"
                                   placeholder="John Doe"
                                   value="{{ old('name', auth()->user()->name) }}"
                                   class="input input-bordered @error('name') input-error @enderror"
                                   required>
                        </label>
                        @error('name')
                        <div class="label -mt-4 mb-2">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </div>
                        @enderror
                        <!-- Update password -->
                        <label class="floating-label mb-6">
                            <span>Change Password</span>
                            <input type="password"
                                   name="password"
                                   placeholder="••••••••"
                                   class="input input-bordered @error('password') input-error @enderror">
                        </label>
                        @error('password')
                        <div class="label -mt-4 mb-2">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </div>
                        @enderror
                        <label class="floating-label mb-6">
                            <span>Confirm Password</span>
                            <input type="password"
                                   name="password_confirmation"
                                   placeholder="••••••••"
                                   class="input input-bordered @error('password_confirmation') input-error @enderror">
                        </label>
                        @error('password_confirmation')
                        <div class="label -mt-4 mb-2">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </div>
                        @enderror
                        <!-- Submit Button -->
                        <div class="form-control mt-8">
                            <button type="submit" class="btn btn-primary btn-sm w-full">
                                Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
