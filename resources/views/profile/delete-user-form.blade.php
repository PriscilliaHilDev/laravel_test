<x-action-section class="bg-white dark:bg-gray-900 rounded-xl shadow-md p-6 border ">
    <x-slot name="title">
        <span class="text-2xl sm:text:xl  font-semibold text-gray-900 dark:text-gray-100 ">
            {{ __('Delete Account') }}
        </span>
    </x-slot>

    <x-slot name="description">
        <span class="text-gray-900 dark:text-gray-100 text-base">
            {{ __('Permanently delete your account.') }}
        </span>
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-base  text-gray-800 dark:text-gray-800">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </div>

        <div class="mt-5">
            <x-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled"
                             class="bg-red-600 hover:bg-red-500 text-white">
                {{ __('Delete Account') }}
            </x-danger-button>
        </div>

        <!-- Delete User Confirmation Modal -->
        <x-dialog-modal wire:model.live="confirmingUserDeletion">
            <x-slot name="title">
                <span class="text-white">{{ __('Delete Account') }}</span>
            </x-slot>

            <x-slot name="content">
                <span class="text-gray-300">
                    {{ __('Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </span>

                <div class="mt-4" 
                     x-data="{}" 
                     x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-input type="password" 
                             class="mt-1 block w-3/4 bg-gray-900 border border-gray-600 text-white"
                             autocomplete="current-password"
                             placeholder="{{ __('Password') }}"
                             x-ref="password"
                             wire:model="password"
                             wire:keydown.enter="deleteUser" />

                    <x-input-error for="password" class="mt-2 text-red-400" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled"
                                    class="bg-gray-700 text-white hover:bg-gray-600">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3 bg-red-600 hover:bg-red-500 text-white"
                                 wire:click="deleteUser"
                                 wire:loading.attr="disabled">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>
    </x-slot>
</x-action-section>
