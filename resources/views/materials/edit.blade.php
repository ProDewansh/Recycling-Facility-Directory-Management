@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header">Edit Material</div>
    <div class="card-body">
        <form action="{{ route('materials.update',$material) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label">Material Name</label>
                <input type="text" name="name" class="form-control" value="{{ $material->name }}" required>
            </div>
            <button class="btn btn-primary">Update</button>
            <a href="{{ route('materials.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
