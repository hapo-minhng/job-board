<x-layout>
    <x-breadcrumbs class="mb-4" :links="['User' => route('user.index'), 'Edit Profile' => '#']" />

    <x-card class="mb-4 text-sm" x-data="">
        <form action="{{ route('user.update', auth()->user()) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="flex">
                <div class="mb-4 mt-4 ml-4">
                    <div class="mb-2 font-bold text-2xl">
                        Edit Profile
                    </div>

                    <div class="grid grid-cols-2 mb-2">
                        <div>
                            <x-label for="name" :required="true">Username</x-label>
                            <x-text-input name="name" :value="auth()->user()->name" />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 mb-2">
                        <div>
                            <x-label for="email" :required="true">Email</x-label>
                            <x-text-input name="email" :value="auth()->user()->email" />
                        </div>
                    </div>

                    <div class="grid grid-cols-4 mb-2">
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
                        <a href="#" class="items-center flex space-x-2 justify-center">Upload image <svg
                                class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M7.5 4.586A2 2 0 0 1 8.914 4h6.172a2 2 0 0 1 1.414.586L17.914 6H19a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h1.086L7.5 4.586ZM10 12a2 2 0 1 1 4 0 2 2 0 0 1-4 0Zm2-4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <x-button
                @click.prevent="$dispatch('toggle-confirmation-popup')">
                Save
            </x-button>

            <x-popup />
        </form>
    </x-card>
</x-layout>
