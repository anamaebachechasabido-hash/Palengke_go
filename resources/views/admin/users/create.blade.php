@extends('layouts.app')

@section('content')
<div class="max-w-md">
    <h1 class="text-xl font-semibold text-gray-800 mb-6">Add User</h1>

    @if ($errors->any())
        <div class="mb-4 rounded bg-red-100 text-red-700 text-sm px-3 py-2">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.users.store') }}" class="bg-white shadow rounded-lg p-6 space-y-4">
        @csrf
        <div>
            <label class="block text-sm text-gray-700 mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required class="w-full border rounded px-3 py-2 text-sm">
        </div>
        <div>
            <label class="block text-sm text-gray-700 mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required class="w-full border rounded px-3 py-2 text-sm">
        </div>
        <div>
            <label class="block text-sm text-gray-700 mb-1">Role</label>
            <select name="role" required class="w-full border rounded px-3 py-2 text-sm">
                @foreach ($roles as $value => $label)
                    <option value="{{ $value }}" @selected(old('role') === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm text-gray-700 mb-1">Password</label>
            <input type="password" name="password" required class="w-full border rounded px-3 py-2 text-sm">
        </div>
        <div>
            <label class="block text-sm text-gray-700 mb-1">Confirm Password</label>
            <input type="password" name="password_confirmation" required class="w-full border rounded px-3 py-2 text-sm">
        </div>
        <div class="flex gap-3 pt-2">
            <button class="bg-emerald-700 hover:bg-emerald-800 text-white px-4 py-2 rounded text-sm">Create</button>
            <a href="{{ route('admin.users.index') }}" class="text-sm text-gray-500 self-center">Cancel</a>
        </div>
    </form>
</div>
@endsection
