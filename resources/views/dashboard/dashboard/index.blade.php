@extends('dashboard.layouts.app')

@section('content')
<div class="flex justify-between items-center pt-3 pb-2 mb-3 border-b">
    <h1 class="text-2xl font-semibold">Dashboard</h1>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white p-6 rounded shadow">
        <h5 class="text-xl font-semibold mb-2">Collections</h5>
        <p class="text-gray-600 mb-4">Manage collections</p>
        <a href="{{ route('dashboard.collections.index') }}" class="bg-accent text-white py-2 px-4 rounded hover:bg-blue-600">View Collections</a>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h5 class="text-xl font-semibold mb-2">Entries</h5>
        <p class="text-gray-600 mb-4">Manage entries</p>
        <a href="{{ route('dashboard.entries.index') }}" class="bg-accent text-white py-2 px-4 rounded hover:bg-blue-600">View Entries</a>
    </div>
</div>
@endsection
