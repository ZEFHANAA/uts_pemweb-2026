<x-filament-panels::page.simple>
    <form method="POST" action="{{ route('admin.login.native') }}" class="space-y-6">
        @csrf

        <div class="grid gap-y-2">
            <label for="email" class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                Email address<span class="text-danger-600 dark:text-danger-400">*</span>
            </label>
            <div class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white dark:bg-white/5 ring-gray-950/10 dark:ring-white/20">
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="fi-input block w-full border-none bg-transparent py-1.5 text-base text-gray-950 focus:ring-0 sm:text-sm sm:leading-6 dark:text-white">
            </div>
            @error('email')
                <p class="fi-fo-field-wrp-error-message text-sm text-danger-600 dark:text-danger-400">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid gap-y-2">
            <div class="flex items-center justify-between gap-x-3">
                <label for="password" class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                    Password<span class="text-danger-600 dark:text-danger-400">*</span>
                </label>
                <a href="{{ filament()->getRequestPasswordResetUrl() }}" class="text-sm font-medium text-primary-600 hover:text-primary-500 dark:text-primary-400">Forgot password?</a>
            </div>
            <div class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white dark:bg-white/5 ring-gray-950/10 dark:ring-white/20">
                <input id="password" name="password" type="password" required autocomplete="current-password" class="fi-input block w-full border-none bg-transparent py-1.5 text-base text-gray-950 focus:ring-0 sm:text-sm sm:leading-6 dark:text-white">
            </div>
            @error('password')
                <p class="fi-fo-field-wrp-error-message text-sm text-danger-600 dark:text-danger-400">{{ $message }}</p>
            @enderror
        </div>

        <label class="flex items-center gap-x-3">
            <input name="remember" type="checkbox" value="1" class="fi-checkbox-input rounded border-gray-300 bg-white text-primary-600 shadow-sm focus:ring-2 focus:ring-primary-600 dark:border-white/10 dark:bg-white/5">
            <span class="text-sm text-gray-700 dark:text-gray-200">Remember me</span>
        </label>

        <button type="submit" class="fi-btn fi-btn-size-md relative grid w-full grid-flow-col items-center justify-center gap-1.5 rounded-lg bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-500 focus-visible:ring-2 focus-visible:ring-primary-600">Sign in</button>
    </form>
</x-filament-panels::page.simple>
