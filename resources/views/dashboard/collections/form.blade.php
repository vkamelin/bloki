@extends('dashboard.layouts.app')

@section('content')
<div class="flex justify-between items-center pt-3 pb-2 mb-3 border-b border-gray-200">
    <h1 class="text-2xl font-semibold text-gray-800">{{ isset($id) ? 'Edit Collection' : 'Create Collection' }}</h1>
</div>

<form method="POST" action="{{ isset($id) ? route('dashboard.collections.update', $id) : route('dashboard.collections.store') }}" class="bg-white rounded-lg shadow-md border border-gray-200">
    @csrf
    @if(isset($id))
        @method('PUT')
    @endif
    
    <div class="p-6">
        <div class="mb-6">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
            <input type="text" class="form-input" id="name" name="name" value="{{ old('name', isset($id) ? 'Sample Collection' : '') }}" placeholder="Enter collection name">
        </div>
        
        <div class="mb-6">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
            <textarea class="form-input" id="description" name="description" rows="4" placeholder="Enter collection description">{{ old('description', isset($id) ? 'Sample description...' : '') }}</textarea>
        </div>
        
        <div class="flex items-center justify-end space-x-3">
            <a href="{{ route('dashboard.collections.index') }}" class="btn-secondary">
                Cancel
            </a>
            <button type="submit" class="btn-primary">
                Save Collection
            </button>
        </div>
    </div>
</form>
@endsection