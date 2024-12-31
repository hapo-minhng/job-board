<x-layout>
    <x-breadcrumbs class="mb-4" :links="['User' => route('user.index')]" />

    <x-card class="mb-4 text-sm" x-data="">
        <div class="flex">
            <div class="mb-4 mt-4 ml-4">
                <div class="mb-2 font-bold text-2xl">
                    User Profile
                </div>

                <div class="grid grid-cols-4 mb-2">
                    <div>
                        Username:
                    </div>

                    <div>
                        {{ auth()->user()->name }}
                    </div>
                </div>

                <div class="grid grid-cols-4 mb-2">
                    <div>
                        Email:
                    </div>

                    <div>
                        {{ auth()->user()->email }}
                    </div>
                </div>

                <div class="grid grid-cols-4 mb-2">
                    <div>
                        Joined at:
                    </div>

                    <div>
                        {{ auth()->user()->created_at->format('Y-m-d') }}
                    </div>
                </div>
            </div>

            <div class="mb-4 mt-4">
                <div class="rounded-md border border-slate-500 px-10 py-12">
                    <svg class="w-20 h-20 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>

                <div class="text-center mt-3 font-semibold">
                    Profile Image
                </div>
            </div>
        </div>

        <x-link-button href="{{ route('user.edit', auth()->user()) }}">Edit Profile</x-link-button>
    </x-card>
</x-layout>
