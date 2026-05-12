<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            <h3 class="text-lg font-medium text-gray-900">Connected Accounts</h3>
                            <p class="mt-1 text-sm text-gray-600">
                                Link external OAuth providers to enable alternative sign-in methods.
                            </p>

                            @if (session('status') === 'account-connected')
                                <p class="mt-2 text-sm font-medium text-green-600">Account successfully connected!</p>
                            @endif

                            @error('status')
                                <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                            @enderror

                            <div class="mt-6 space-y-4">
                                <div class="flex items-center justify-between p-4 border rounded-md">
                                    <div>
                                        <p class="font-medium text-gray-800">GitHub</p>
                                        @if(auth()->user()->provider === 'github')
                                            <p class="text-xs text-green-600 font-semibold">Connected</p>
                                        @else
                                            <p class="text-xs text-gray-500">Not connected</p>
                                        @endif
                                    </div>

                                    @if(auth()->user()->provider === 'github')
                                        <div class="flex items-center space-x-2">
                                            @if(auth()->user()->avatar)
                                                <img src="{{ auth()->user()->avatar }}" alt="Avatar" class="w-7 h-7 rounded-full border">
                                            @endif
                                            <span class="text-sm text-gray-600 font-mono">{{ auth()->user()->name }}</span>
                                        </div>
                                    @else
                                        <a href="{{ route('socialite.redirect', 'github') }}" class="px-3 py-1.5 text-xs font-semibold text-white bg-gray-800 rounded hover:bg-gray-700 transition">
                                            Connect GitHub
                                        </a>
                                    @endif
                                </div>

                                <div class="flex items-center justify-between p-4 border rounded-md">
                                    <div>
                                        <p class="font-medium text-gray-800">Google</p>
                                        @if(auth()->user()->provider === 'google')
                                            <p class="text-xs text-green-600 font-semibold">Connected</p>
                                        @else
                                            <p class="text-xs text-gray-500">Not connected</p>
                                        @endif
                                    </div>

                                    @if(auth()->user()->provider === 'google')
                                        <div class="flex items-center space-x-2">
                                            @if(auth()->user()->avatar)
                                                <img src="{{ auth()->user()->avatar }}" alt="Avatar" class="w-7 h-7 rounded-full border">
                                            @endif
                                            <span class="text-sm text-gray-600">{{ auth()->user()->email }}</span>
                                        </div>
                                    @else
                                        <a href="{{ route('socialite.redirect', 'google') }}" class="px-3 py-1.5 text-xs font-semibold text-white bg-red-600 rounded hover:bg-red-500 transition">
                                            Connect Google
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
