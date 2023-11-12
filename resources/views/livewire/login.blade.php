<div class="w-full max-w-md">
    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" wire:submit.prevent="login">
        @csrf
        <div class="divide-y divide-gray-700">
            <div class="my-5 text-center">
                <h1 class="text-3xl text-black">MusicMGMT</h1>
            </div>
            <div>
                <br>
                <div class="relative mb-6 text-black">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                        <i class="fa fa-envelope"></i>
                    </div>

                    <input
                            type="email"
                            id="login-email"
                            class="border text-sm rounded-lg focus:ring-blue-500 block w-full pl-10 p-2.5"
                            placeholder="Email"
                            wire:model="email" required>
                </div>

                <div class="relative mb-6 text-black">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </div>
                    <input type="password"
                           id="login-password"
                           class="border text-sm rounded-lg focus:ring-blue-500 block w-full pl-10 p-2.5"
                           placeholder="Password"
                           wire:model="password" required>
                </div>

                <div class="text-center items-center justify-between">
                    <button class="bg-gray-800 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="submit">
                        Log in
                    </button>
                </div>

                @error('loginFailed')
                <span class="flex items-center justify-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                <p class="text-center text-red-700">{{ $message }}</p>
            </span>
                @enderror

            </div>
        </div>
    </form>
    <p class="text-center text-gray-500 text-xs">
        &copy;{{ now()->year }} MusicMGMT. All rights reserved.
    </p>
</div>
