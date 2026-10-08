<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'PalengkE-Go' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    @auth
    <nav class="bg-emerald-700 text-white">
        <div class="max-w-5xl mx-auto px-4 py-3 flex items-center justify-between">
            <div class="flex items-center gap-6">
                <span class="font-semibold">PalengkE-Go</span>
                <a href="{{ route('dashboard') }}" class="text-sm text-emerald-100 hover:text-white">Dashboard</a>
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.users.index') }}" class="text-sm text-emerald-100 hover:text-white">User Management</a>
                @endif
            </div>
            <div class="flex items-center gap-4 text-sm">
                <span class="text-emerald-100">{{ auth()->user()->name }} &middot; {{ auth()->user()->roleLabel() }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="bg-emerald-800 hover:bg-emerald-900 px-3 py-1.5 rounded text-white">Log out</button>
                </form>
            </div>
        </div>
    </nav>
    @endauth

    <main class="max-w-5xl mx-auto px-4 py-8">
        @if (session('status'))
            <div class="mb-4 rounded bg-green-100 text-green-800 px-4 py-2 text-sm">{{ session('status') }}</div>
        @endif
        @if (session('error'))
            <div class="mb-4 rounded bg-red-100 text-red-800 px-4 py-2 text-sm">{{ session('error') }}</div>
        @endif

        @yield('content')
    </main>
</body>
</html>
