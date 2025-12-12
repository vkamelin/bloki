@extends('dashboard.layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Article Form</h1>
</div>

<form method="POST" action="{{ isset($id) ? route('articles.update', $id) : route('articles.store') }}">
    @csrf
    @if(isset($id))
        @method('PUT')
    @endif
    
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', isset($id) ? 'Sample Article' : '') }}">
    </div>
    
    <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea class="form-control" id="content" name="content" rows="10">{{ old('content', isset($id) ? 'Sample content...' : '') }}</textarea>
    </div>
    
    <div class="mb-3">
        <label for="author" class="form-label">Author</label>
        <input type="text" class="form-control" id="author" name="author" value="{{ old('author', isset($id) ? 'John Doe' : '') }}">
    </div>
    
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ route('articles.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection