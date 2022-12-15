
@push('scripts')
    <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>
    <script src="https://unpkg.com/flowbite@1.5.5/dist/datepicker.js"></script>
@endpush

<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="phone" :value="__('Phone number')" />

                <x-text-input id="phone" class="block mt-1 w-full"
                              type="text"
                              name="phone"
                              required />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Secret Key -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Secret Key')" />

                <x-text-input id="secretKey" class="block mt-1 w-full" type="text" name="secretKey" required autofocus />
            </div>


            <!-- Date of birth -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('BirthDate')" />

                <x-datepicker datepicker-format="yyyy-mm-dd" name="birthDate" />
            </div>

            <!-- gender -->
            <div class="mt-4">
                <x-input-label for="gender" :value="__('Gender')" />

                <x-radio checked type="radio" id="male" name="gender" value="male" label="Мужской"  mb="mb-4"/>
                <x-radio type="radio" id="female" name="gender" value="female" label="Женский" />
            </div>

            <!-- Avatar -->
            <div class="mt-4">
                <x-input-label for="avatar" :value="__('Avatar (optional)')" />

                <x-text-input id="avatar" class="block mt-1 w-full"
                              type="file"
                              name="avatar" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ml-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
