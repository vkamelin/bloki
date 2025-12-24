@extends('dashboard.layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Collection Form</h1>
</div>

<form method="POST" action="{{ isset($id) ? route('dashboard.collections.update', $id) : route('dashboard.collections.store') }}">
    @csrf
    @if(isset($id))
        @method('PUT')
    @endif
    
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', isset($id) ? 'Sample Collection' : '') }}">
    </div>
    
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', isset($id) ? 'Sample description...' : '') }}</textarea>
    </div>
    
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ route('dashboard.collections.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection