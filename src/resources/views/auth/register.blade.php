<x-guest-layout>
    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center" style="letter-spacing: 0.05em;">新規登録</h2>

    <form method="POST" action="{{ secure_url(route('register', [], false)) }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2" style="letter-spacing: 0.05em;">
                {{ __('Name') }}
            </label>
            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name') }}"
                required
                autofocus
                autocomplete="name"
                class="form-input block w-full px-4 py-3 text-base border-2 border-gray-300 bg-white focus:outline-none focus:border-green-500 transition-all"
                placeholder="山田 太郎" />
            @error('name')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2" style="letter-spacing: 0.05em;">
                {{ __('Email') }}
            </label>
            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email') }}"
                required
                autocomplete="username"
                class="form-input block w-full px-4 py-3 text-base border-2 border-gray-300 bg-white focus:outline-none focus:border-green-500 transition-all"
                placeholder="your@example.com" />
            @error('email')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2" style="letter-spacing: 0.05em;">
                {{ __('Password') }}
            </label>
            <input
                id="password"
                name="password"
                type="password"
                required
                autocomplete="new-password"
                class="form-input block w-full px-4 py-3 text-base border-2 border-gray-300 bg-white focus:outline-none focus:border-green-500 transition-all"
                placeholder="8文字以上" />
            @error('password')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2" style="letter-spacing: 0.05em;">
                {{ __('Confirm Password') }}
            </label>
            <input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                required
                autocomplete="new-password"
                class="form-input block w-full px-4 py-3 text-base border-2 border-gray-300 bg-white focus:outline-none focus:border-green-500 transition-all"
                placeholder="パスワードを再入力" />
            @error('password_confirmation')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full py-3 px-4 text-base font-semibold text-white bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105 shadow-md" style="letter-spacing: 0.1em;">
            {{ __('Register') }}
        </button>

        <!-- Login Link -->
        <div class="text-center mt-4">
            <a class="text-sm text-gray-600 hover:text-green-600 underline transition-colors" href="{{ route('login') }}" style="letter-spacing: 0.03em;">
                {{ __('Already registered?') }}
            </a>
        </div>
    </form>
</x-guest-layout>
