@extends('layouts.app')
@section('content')
<h2>Materials</h2>
<a href="{{ route('materials.create') }}" class="btn btn-success mb-3">Add Material</a>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr><th>Name</th>
         <th>Actions</th></tr>
    </thead>
    <tbody>
    @foreach($materials as $m)
        <tr>
            <td>{{ $m->name }}</td>
            <td>
                <a href="{{ route('materials.edit',$m) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('materials.destroy',$m) }}" method="POST" style="display:inline-block;">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this material?')">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $materials->links() }}
@endsection
