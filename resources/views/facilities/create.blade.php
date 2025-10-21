@extends('layouts.app')

@section('styles')
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="card">
    <div class="card-header">Add New Facility</div>
    <div class="card-body">
        <form action="{{ route('facilities.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Business Name</label>
                <input type="text" name="business_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Last Update Date</label>
                <input type="date" name="last_update_date" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Street Address</label>
                <input type="text" name="street_address" class="form-control" required>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">City</label>
                    <input type="text" name="city" class="form-control" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">State</label>
                    <input type="text" name="state" class="form-control" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Postal Code</label>
                    <input type="text" name="postal_code" class="form-control" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Materials Accepted</label>
                <select name="materials[]" class="form-select select2" multiple="multiple" required>
                    @foreach($materials as $m)
                        <option value="{{ $m->id }}">{{ $m->name }}</option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-success">Save Facility</button>
            <a href="{{ route('facilities.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Select Materials",
            allowClear: true,
            width: '100%'
        });
    });
</script>
@endsection
