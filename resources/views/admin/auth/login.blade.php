<x-guest-layout>
    <div class="max-w-md mx-auto mt-10 bg-white p-6 shadow rounded">
        <h1 class="text-2xl font-bold mb-4 text-center">Login Admin</h1>

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf

            <label class="block mb-1 font-semibold">Username</label>
            <input class="border rounded w-full p-2 mb-3" type="text" name="username" required>

            <label class="block mb-1 font-semibold">Password</label>
            <input class="border rounded w-full p-2 mb-3" type="password" name="password" required>

            @error('username')
                <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
            @enderror

            <button class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">
                Login
            </button>
        </form>
    </div>
</x-guest-layout>
