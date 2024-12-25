<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel Job Board</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body
    class="mx-auto mt-10 max-w-2xl text-slate-700
bg-gradient-to-r from-indigo-200 from-10% via-sky-200 via-30% to-emerald-200 to-90%">
    <nav class="mb-8 flex justify-between text-lg font-medium">
        <ul class="flex space-x-2">
            <li>
                <a href="{{ route('jobs.index') }}">Home</a>
            </li>
        </ul>

        <ul class="flex space-x-2">
            @auth
                <li>
                    <a href="{{ route('my-job-applications.index') }}">
                        {{ auth()->user()->name ?? 'Guest' }}: Applications |
                    </a>
                </li>
                <li>
                    <form action="{{ route('auth.destroy') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button>Logout</button>
                    </form>
                </li>
            @else
                <li>
                    <a href="{{ route('auth.create') }}">Sign in</a>
                </li>
            @endauth
        </ul>
    </nav>

    @if (session('success'))
        <div x-data="{ flash: true }">
            <div x-show="flash">
                <div class="my-8 relative rounded-md border-l-4 border-green-300 bg-green-100 p-4 text-green-700 opacity-75 px-4 py-3"
                    role="alert">

                    <div><strong class="font-bold">Success!</strong></div>
                    <div>{{ session('success') }}</div>

                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            @click="flash = false" stroke="currentColor" class="h-6 w-6 cursor-pointer">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </span>
                </div>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div x-data="{ flash: true }">
            <div x-show="flash">
                <div class="my-8 relative rounded-md border-l-4 border-red-300 bg-red-100 p-4 text-red-700 opacity-75 px-4 py-3"
                    role="alert">

                    <div><strong class="font-bold">Error!</strong></div>
                    <div>{{ session('error') }}</div>

                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            @click="flash = false" stroke="currentColor" class="h-6 w-6 cursor-pointer">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </span>
                </div>
            </div>
        </div>
    @endif

    {{ $slot }}
</body>

</html>
