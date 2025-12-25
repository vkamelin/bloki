@extends('dashboard.layouts.app')

@section('content')
<div class="flex justify-between items-center pt-3 pb-2 mb-3 border-b border-gray-200">
    <h1 class="text-2xl font-semibold text-gray-800">{{ isset($id) ? 'Edit Entry' : 'Create Entry' }}</h1>
</div>

<form method="POST" action="{{ isset($id) ? route('dashboard.entries.update', $id) : route('dashboard.entries.store') }}" class="bg-white rounded-lg shadow-md border border-gray-200">
    @csrf
    @if(isset($id))
        @method('PUT')
    @endif
    
    <div class="p-6">
        <div class="mb-6">
            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
            <input type="text" class="form-input" id="title" name="title" value="{{ old('title', isset($id) ? 'Sample Entry' : '') }}" placeholder="Enter entry title">
        </div>
        
        <div class="mb-6">
            <label for="collection" class="block text-sm font-medium text-gray-700 mb-2">Collection</label>
            <select class="form-input" id="collection" name="collection">
                <option value="">Select Collection</option>
                <option value="1" {{ old('collection', isset($id) ? '1' : '') == '1' ? 'selected' : '' }}>Sample Collection</option>
            </select>
        </div>
        
        <div class="mb-6">
            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content</label>
            <textarea class="form-input" id="content" name="content" rows="12" placeholder="Enter entry content">{{ old('content', isset($id) ? 'Sample content...' : '') }}</textarea>
        </div>
        
        <div class="flex items-center justify-end space-x-3">
            <a href="{{ route('dashboard.entries.index') }}" class="btn-secondary">
                Cancel
            </a>
            <button type="submit" class="btn-primary">
                Save Entry
            </button>
        </div>
    </div>
</form>
@endsection
