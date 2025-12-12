@extends('dashboard.layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">User Form</h1>
</div>

<form method="POST" action="{{ isset($id) ? route('users.update', $id) : route('users.store') }}">
    @csrf
    @if(isset($id))
        @method('PUT')
    @endif
    
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', isset($id) ? 'John Doe' : '') }}">
    </div>
    
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', isset($id) ? 'john@example.com' : '') }}">
    </div>
    
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection