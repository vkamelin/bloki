@extends('dashboard.layouts.app')

@section('content')
<div class="flex justify-between items-center pt-3 pb-2 mb-3 border-b border-gray-200">
    <h1 class="text-2xl font-semibold text-gray-800">{{ isset($id) ? 'Edit User' : 'Create User' }}</h1>
</div>

<form method="POST" action="{{ isset($id) ? route('users.update', $id) : route('users.store') }}" class="bg-white rounded-lg shadow-md border border-gray-200">
    @csrf
    @if(isset($id))
        @method('PUT')
    @endif
    
    <div class="p-6">
        <div class="mb-6">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
            <input type="text" class="form-input" id="name" name="name" value="{{ old('name', isset($id) ? 'John Doe' : '') }}" placeholder="Enter user name">
        </div>
        
        <div class="mb-6">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
            <input type="email" class="form-input" id="email" name="email" value="{{ old('email', isset($id) ? 'john@example.com' : '') }}" placeholder="Enter user email">
        </div>
        
        <div class="flex items-center justify-end space-x-3">
            <a href="{{ route('users.index') }}" class="btn-secondary">
                Cancel
            </a>
            <button type="submit" class="btn-primary">
                Save User
            </button>
        </div>
    </div>
</form>
@endsection