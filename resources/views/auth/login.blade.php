@extends('layouts.app')

@section('content')
<div class="max-w-sm mx-auto bg-white shadow rounded-lg p-6 mt-10">
    <h1 class="text-xl font-semibold text-gray-800 mb-1">PalengkE-Go</h1>
    <p class="text-sm text-gray-500 mb-6">Log in to your account</p>

    @if ($errors->any())
        <div class="mb-4 rounded bg-red-100 text-red-700 text-sm px-3 py-2">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm text-gray-700 mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                class="w-full border rounded px-3 py-2 text-sm">
        </div>
        <div>
            <label class="block text-sm text-gray-700 mb-1">Password</label>
            <input type="password" name="password" required class="w-full border rounded px-3 py-2 text-sm">
        </div>
        <label class="flex items-center gap-2 text-sm text-gray-600">
            <input type="checkbox" name="remember"> Remember me
        </label>
        <button class="w-full bg-emerald-700 hover:bg-emerald-800 text-white py-2 rounded text-sm font-medium">
            Log in
        </button>
    </form>

    <p class="text-sm text-gray-500 mt-4">
        No account? <a href="{{ route('register') }}" class="text-emerald-700 underline">Register as a customer</a>
    </p>

    <div class="mt-6 border-t pt-4 text-xs text-gray-400">
        Demo accounts (password: <code>password</code>):<br>
        admin@palengke.go &middot; vendor@palengke.go &middot; customer@palengke.go &middot; delivery@palengke.go
    </div>
</div>
@endsection
