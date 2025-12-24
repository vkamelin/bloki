@extends('dashboard.layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Entry Form</h1>
</div>

<form method="POST" action="{{ isset($id) ? route('dashboard.entries.update', $id) : route('dashboard.entries.store') }}">
    @csrf
    @if(isset($id))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', isset($id) ? 'Sample Entry' : '') }}">
    </div>

    <div class="mb-3">
        <label for="collection" class="form-label">Collection</label>
        <select class="form-control" id="collection" name="collection">
            <option value="">Select Collection</option>
            <option value="1" {{ old('collection', isset($id) ? '1' : '') == '1' ? 'selected' : '' }}>Sample Collection</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea class="form-control" id="content" name="content" rows="10">{{ old('content', isset($id) ? 'Sample content...' : '') }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ route('dashboard.entries.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
