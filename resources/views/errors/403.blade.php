<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>403 - Access Denied</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="bg-white shadow rounded-lg p-10 text-center max-w-sm">
        <h1 class="text-3xl font-bold text-red-600">403</h1>
        <p class="text-lg font-semibold text-gray-800 mt-2">Access Denied</p>
        <p class="text-sm text-gray-500 mt-2">
            {{ $exception->getMessage() ?: 'You do not have permission to view this page.' }}
        </p>
        @auth
            <a href="{{ route('dashboard') }}" class="inline-block mt-6 text-emerald-700 underline text-sm">
                Return to your dashboard
            </a>
        @else
            <a href="{{ route('login') }}" class="inline-block mt-6 text-emerald-700 underline text-sm">
                Log in
            </a>
        @endauth
    </div>
</body>
</html>
