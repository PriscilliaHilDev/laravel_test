<x-form-section submit="updateProfileInformation" class="bg-white dark:bg-gray-900 rounded-xl shadow-md p-6">
    <x-slot name="title">
        <span class="text-gray-900 dark:text-gray-100 text-2xl sm:text:xl ">
            {{ __('Profile Information') }}
        </span>
    </x-slot>

    <x-slot name="description">
        <span class="text-gray-900 dark:text-gray-100 text-base">
            {{ __('Update your account\'s profile information and email address.') }}
        </span>
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <x-label for="photo" value="{{ __('Photo') }}" class="text-white" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" 
                         alt="{{ $this->user->name }}" 
                         class="rounded-full size-20 object-cover shadow-md border border-gray-700">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full size-20 bg-cover bg-no-repeat bg-center shadow-md border border-gray-700"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-secondary-button class="mt-2 me-2 bg-gray-700 text-white hover:bg-gray-600"
                                    type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-secondary-button type="button" class="mt-2 bg-gray-700 text-white hover:bg-gray-600"
                                        wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-secondary-button>
                @endif

                <x-input-error for="photo" class="mt-2 text-red-400" />
            </div>
        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Name') }}" class="text-white dark:text-gray-800"  />
            <x-input id="name" type="text"
                     class="mt-2 block w-full rounded-lg 
                            bg-gray-50 dark:bg-gray-800 
                            border border-gray-300 dark:border-gray-600 
                            text-gray-900 dark:text-gray-100
                            focus:border-indigo-500 focus:ring-indigo-500
                            transition"
                     wire:model="state.name" required autocomplete="name" />
            <x-input-error for="name" class="mt-2 text-red-400" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Email') }}" class="text-white dark:text-gray-800" />
            <x-input id="email" type="email"
                     class="mt-2 block w-full rounded-lg 
                            bg-gray-50 dark:bg-gray-800 
                            border border-gray-300 dark:border-gray-600 
                            text-gray-900 dark:text-gray-100
                            focus:border-indigo-500 focus:ring-indigo-500
                            transition"
                     wire:model="state.email" required autocomplete="username" />
            <x-input-error for="email" class="mt-2 text-red-400" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <p class="text-sm mt-2 text-gray-300">
                    {{ __('Your email address is unverified.') }}

                    <button type="button"
                            class="underline text-sm text-indigo-400 hover:text-indigo-300"
                            wire:click.prevent="sendEmailVerification">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p class="mt-2 font-medium text-sm text-green-400">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3 text-gray-300" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo"
                  class="bg-indigo-600 hover:bg-indigo-500 text-white">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
