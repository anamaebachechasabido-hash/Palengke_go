@extends('layouts.app')

@section('content')
<div class="max-w-sm mx-auto bg-white shadow rounded-lg p-6 mt-10">
    <h1 class="text-xl font-semibold text-gray-800 mb-1">Create a Customer account</h1>
    <p class="text-sm text-gray-500 mb-6">Vendor, Delivery, and Admin accounts are created by an Administrator.</p>

    @if ($errors->any())
        <div class="mb-4 rounded bg-red-100 text-red-700 text-sm px-3 py-2">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm text-gray-700 mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required autofocus
                class="w-full border rounded px-3 py-2 text-sm">
        </div>
        <div>
            <label class="block text-sm text-gray-700 mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                class="w-full border rounded px-3 py-2 text-sm">
        </div>
        <div>
            <label class="block text-sm text-gray-700 mb-1">Password</label>
            <input type="password" name="password" required class="w-full border rounded px-3 py-2 text-sm">
        </div>
        <div>
            <label class="block text-sm text-gray-700 mb-1">Confirm Password</label>
            <input type="password" name="password_confirmation" required class="w-full border rounded px-3 py-2 text-sm">
        </div>
        <button class="w-full bg-emerald-700 hover:bg-emerald-800 text-white py-2 rounded text-sm font-medium">
            Register
        </button>
    </form>

    <p class="text-sm text-gray-500 mt-4">
        Already have an account? <a href="{{ route('login') }}" class="text-emerald-700 underline">Log in</a>
    </p>
</div>
@endsection
