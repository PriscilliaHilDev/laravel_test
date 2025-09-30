<x-form-section submit="updatePassword" 
    class="bg-white dark:bg-gray-900 rounded-xl shadow-md p-8 border border-gray-200 dark:border-gray-700">
    
    <x-slot name="title">
        <span class="text-2xl sm:text:xl  font-semibold text-gray-900 dark:text-gray-100">
            {{ __('Update Password') }}
        </span>
    </x-slot>

    <x-slot name="description">
        <span class="text-gray-800 dark:text-gray-100 text-base">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </span>
    </x-slot>

    <x-slot name="form">
        <!-- Current Password -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="current_password" value="{{ __('Current Password') }}" 
                     class="text-gray-800 dark:text-gray-800 font-medium" />
            <x-input id="current_password" type="password"
                     class="mt-2 block w-full rounded-lg 
                            bg-gray-50 dark:bg-gray-800 
                            border border-gray-300 dark:border-gray-600 
                            text-gray-900 dark:text-gray-100
                            focus:border-indigo-500 focus:ring-indigo-500
                            transition"
                     wire:model="state.current_password"
                     autocomplete="current-password" />
            <x-input-error for="current_password" class="mt-2 text-red-500" />
        </div>

        <!-- New Password -->
        <div class="col-span-6 sm:col-span-4 mt-4">
            <x-label for="password" value="{{ __('New Password') }}" 
                     class="text-gray-800 dark:text-gray-800 font-medium" />
            <x-input id="password" type="password"
                     class="mt-2 block w-full rounded-lg 
                            bg-gray-50 dark:bg-gray-800 
                            border border-gray-300 dark:border-gray-600 
                            text-gray-900 dark:text-gray-100
                            focus:border-indigo-500 focus:ring-indigo-500
                            transition"
                     wire:model="state.password"
                     autocomplete="new-password" />
            <x-input-error for="password" class="mt-2 text-red-500" />
        </div>

        <!-- Confirm Password -->
        <div class="col-span-6 sm:col-span-4 mt-4">
            <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" 
                     class="text-gray-800 dark:text-gray-800 font-medium" />
            <x-input id="password_confirmation" type="password"
                     class="mt-2 block w-full rounded-lg 
                            bg-gray-50 dark:bg-gray-800 
                            border border-gray-300 dark:border-gray-600 
                            text-gray-900 dark:text-gray-100
                            focus:border-indigo-500 focus:ring-indigo-500
                            transition"
                     wire:model="state.password_confirmation"
                     autocomplete="new-password" />
            <x-input-error for="password_confirmation" class="mt-2 text-red-500" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3 text-gray-700 dark:text-gray-300" on="saved">
            ✅ {{ __('Saved.') }}
        </x-action-message>

        <x-button 
            class="px-5 py-2 rounded-lg font-semibold
                   bg-indigo-600 hover:bg-indigo-500 
                   dark:bg-indigo-500 dark:hover:bg-indigo-400 
                   text-white transition">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
