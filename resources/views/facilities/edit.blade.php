@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header">Edit Facility</div>
    <div class="card-body">
        <form action="{{ route('facilities.update',$facility) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Business Name</label>
                <input type="text" name="business_name" class="form-control" value="{{ $facility->business_name }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Last Update Date</label>
                <input type="date" name="last_update_date" class="form-control" value="{{ $facility->last_update_date }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Street Address</label>
                <input type="text" name="street_address" class="form-control" value="{{ $facility->street_address }}" required>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">City</label>
                    <input type="text" name="city" class="form-control" value="{{ $facility->city }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">State</label>
                    <input type="text" name="state" class="form-control" value="{{ $facility->state }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Postal Code</label>
                    <input type="text" name="postal_code" class="form-control" value="{{ $facility->postal_code }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Currently Selected Materials</label>
                <input type="text" class="form-control" 
                    value="{{ $facility->materials->pluck('name')->implode(', ') }}" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Materials Accepted</label>
                <select name="materials[]" class="form-select" multiple required>
                    @foreach($materials as $m)
                        {{-- <option value="{{ $m->id }}" {{ $facility->materials->contains($m->id) ? 'selected' : '' }}>{{ $m->name }}</option> --}}
                        <option value="{{ $m->id }}" {{ (collect(old('materials'))->contains($m->id)) ? 'selected' : '' }}>
                            {{ $m->name }}
                        </option>
                        
                    @endforeach
                </select>
            </div>
            <button class="btn btn-primary">Update Facility</button>
            <a href="{{ route('facilities.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
