@extends('dashboard.layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Collections</h5>
                <p class="card-text">Manage collections</p>
                <a href="{{ route('dashboard.collections.index') }}" class="btn btn-primary">View Collections</a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mt-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Entries</h5>
                <p class="card-text">Manage entries</p>
                <a href="{{ route('dashboard.entries.index') }}" class="btn btn-primary">View Entries</a>
            </div>
        </div>
    </div>
</div>
@endsection
