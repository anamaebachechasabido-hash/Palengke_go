@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg p-8 text-center">
    <h1 class="text-2xl font-bold text-gray-800">Welcome Admin!</h1>
    <p class="text-gray-500 mt-2">Administrator Dashboard</p>

    <div class="grid sm:grid-cols-2 gap-4 mt-8 text-left">
        <div class="border rounded-lg p-4">
            <h2 class="font-semibold text-gray-700">Current Weather</h2>
            @if(isset($weather) && $weather)
                <p class="text-sm text-gray-500 mt-1">Location: <strong>{{ $weather['city'] }}</strong></p>
                <p class="text-sm text-gray-500 mt-1">Temperature: <strong>{{ $weather['temperature'] }}°C</strong></p>
                <p class="text-sm text-gray-500 mt-1">Condition: <strong>{{ ucfirst($weather['description'] ?? 'N/A') }}</strong></p>
                <p class="text-sm text-gray-500 mt-1">Humidity: <strong>{{ $weather['humidity'] }}%</strong></p>
                <p class="text-sm text-gray-500 mt-1">Wind Speed: <strong>{{ $weather['wind_speed'] }} m/s</strong></p>
            @else
                <p class="text-sm text-gray-500 mt-1">Weather information is currently unavailable.</p>
            @endif
        </div>
        <div class="border rounded-lg p-4">
            <h2 class="font-semibold text-gray-700">User Management</h2>
            <p class="text-sm text-gray-500 mt-1">Manage all customer, vendor, delivery, and admin accounts.</p>
            <a href="{{ route('admin.users.index') }}" class="text-sm text-emerald-700 underline mt-2 inline-block">Go to User Management</a>
        </div>
        <div class="border rounded-lg p-4">
            <h2 class="font-semibold text-gray-700">System Overview</h2>
            <p class="text-sm text-gray-500 mt-1">Vendors, products, orders, and delivery records (future modules).</p>
        </div>
    </div>
</div>
@endsection
