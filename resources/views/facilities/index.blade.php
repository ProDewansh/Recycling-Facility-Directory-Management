@extends('layouts.app')
@section('content')
<h2>Recycling Facilities</h2>

<form method="GET" action="{{ route('facilities.index') }}" class="row mb-3">
    <div class="col-md-3"><input type="text" name="search" class="form-control" placeholder="Search by name/city"></div>
    <div class="col-md-3">
        <select name="material_id" class="form-control">
            <option value="">Filter by Material</option>
            @foreach($materials as $m)
                <option value="{{ $m->id }}">{{ $m->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <select name="sort" class="form-control">
            <option value="">Sort</option>
            <option value="last_update">Last Updated</option>
        </select>
    </div>
    <div class="col-md-2"><button class="btn btn-primary">Search</button></div>
    {{-- <div class="col-md-2"><a href="{{ route('facilities.export') }}" class="btn btn-success">Export CSV</a></div> --}}
    <a href="{{ route('facilities.export', request()->query()) }}" style="width: 150px;" class="btn btn-success">Export CSV</a>
    <a href="{{ route('materials.index') }}" style="width: 150px;   margin:2px;" class="btn btn-info">Add Material</a>
    <a href="{{ route('facilities.create')}}" style="width: 150px;margin:2px; " class="btn btn-success">Add Facility</a>
    
</form>

<table class="table table-bordered table-striped">
    <thead><tr> <th>Sr. No.</th><th>Business Name</th><th>Last Updated</th><th>Address</th><th>Materials</th><th>Actions</th></tr></thead>
    <tbody>
    @foreach($facilities as $f)
        <tr>
            <td>{{ $loop->iteration }}</td> <!-- Serial Number -->
            <td>{{ $f->business_name }}</td>
            <td>{{ $f->last_update_date }}</td>
            <td>{{ $f->street_address }}, {{ $f->city }} {{ $f->state }} {{ $f->postal_code }}</td>
            <td>{{ $f->materials->pluck('name')->join(', ') }}</td>
            <td>
                <a href="{{ route('facilities.show',$f) }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ route('facilities.edit',$f) }}" class="btn btn-warning btn-sm">Edit</a>
               

                <form method="POST" action="{{ route('facilities.destroy',$f) }}" style="display:inline-block;">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this?')">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $facilities->links() }}
@endsection
