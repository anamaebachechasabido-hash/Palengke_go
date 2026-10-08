@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-xl font-semibold text-gray-800">User Management</h1>
    <a href="{{ route('admin.users.create') }}" class="bg-emerald-700 hover:bg-emerald-800 text-white text-sm px-4 py-2 rounded">
        + Add User
    </a>
</div>

<div class="bg-white shadow rounded-lg overflow-hidden">
    <table class="w-full text-sm text-left">
        <thead class="bg-gray-100 text-gray-600">
            <tr>
                <th class="px-4 py-3">Name</th>
                <th class="px-4 py-3">Email</th>
                <th class="px-4 py-3">Role</th>
                <th class="px-4 py-3 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @foreach ($users as $u)
                <tr>
                    <td class="px-4 py-3">{{ $u->name }}</td>
                    <td class="px-4 py-3">{{ $u->email }}</td>
                    <td class="px-4 py-3">
                        <span class="inline-block bg-emerald-100 text-emerald-800 text-xs px-2 py-1 rounded">
                            {{ $u->roleLabel() }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-right space-x-2">
                        <a href="{{ route('admin.users.edit', $u) }}" class="text-emerald-700 underline">Edit</a>
                        @if ($u->id !== auth()->id())
                            <form action="{{ route('admin.users.destroy', $u) }}" method="POST" class="inline"
                                onsubmit="return confirm('Delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 underline">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $users->links() }}
</div>
@endsection
