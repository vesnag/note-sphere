<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Picture') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your profile picture.") }}
        </p>
    </header>

    <form method="POST" action="{{ route('profile.update.picture') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('PUT')

        <div>
            <x-input-label for="profile_picture" :value="__('Profile Picture')" />
            <input type="file" name="profile_picture" id="profile_picture" class="mt-1 block w-full">
            <x-input-error class="mt-2" :messages="$errors->get('profile_picture')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Update Profile Picture') }}</x-primary-button>

            @if (session('status') === 'profile-picture-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Updated.') }}</p>
            @endif
        </div>
    </form>
</section>
