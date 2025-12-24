@extends('dashboard.layouts.app')

@section('content')
<div class="flex justify-between items-center pt-3 pb-2 mb-3 border-b">
    <h1 class="text-2xl font-semibold">Collections</h1>
    <div class="mb-2">
        <a href="{{ route('dashboard.collections.create') }}" class="bg-accent text-white py-2 px-4 rounded hover:bg-blue-600">Add Collection</a>
    </div>
</div>

<div class="overflow-x-auto">
    <table class="min-w-full bg-white rounded">
        <thead>
            <tr class="bg-gray-100">
                <th class="py-2 px-4 text-left">ID</th>
                <th class="py-2 px-4 text-left">Name</th>
                <th class="py-2 px-4 text-left">Entries</th>
                <th class="py-2 px-4 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Collection data would be populated here -->
            <tr class="border-b">
                <td class="py-2 px-4">1</td>
                <td class="py-2 px-4">Sample Collection</td>
                <td class="py-2 px-4">10</td>
                <td class="py-2 px-4">
                    <a href="{{ route('dashboard.collections.edit', 1) }}" class="bg-gray-500 text-white py-1 px-3 rounded hover:bg-gray-600 mr-2">Edit</a>
                    <button class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection