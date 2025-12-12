@extends('dashboard.layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Articles</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('articles.create') }}" class="btn btn-sm btn-outline-secondary">Add Article</a>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Published Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Article data would be populated here -->
            <tr>
                <td>1</td>
                <td>Sample Article</td>
                <td>John Doe</td>
                <td>2023-01-01</td>
                <td>
                    <a href="{{ route('articles.edit', 1) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection