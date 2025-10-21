@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header">Add New Material</div>
    <div class="card-body">
        <form action="{{ route('materials.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Material Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <button class="btn btn-success">Save Material</button>
            <a href="{{ route('materials.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
