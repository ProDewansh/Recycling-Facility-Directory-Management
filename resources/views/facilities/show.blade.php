@extends('layouts.app')
@section('content')
<div class="card">
   
    
    <div class="card-header bg-blue-300">Company Name : {{ $facility->business_name }}</div>
    <div class="card-body">
        <p><strong>Last Updated:</strong> {{ $facility->last_update_date }}</p>
        <p><strong>Address:</strong> {{ $facility->street_address }}, {{ $facility->city }}, {{ $facility->state }} {{ $facility->postal_code }}</p>
        <p><strong>Materials Accepted:</strong> {{ $facility->materials->pluck('name')->join(', ') }}</p>
        
        <div class="mt-3">
            <h5>Facility Location (Map)</h5>
            <div id="map" style="height:300px; border-radius:8px; overflow:hidden;"></div>
        </div>

        <div class="mt-3">
            <a href="{{ route('facilities.index') }}" class="btn btn-secondary">Back</a>
            <a href="{{ route('facilities.edit',$facility) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
</div>

{{-- Leaflet JS & CSS --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Address fields ko combine karna
    let address = "{{ $facility->street_address }} {{ $facility->city }} {{ $facility->state }} {{ $facility->postal_code }}";

    // Nominatim API call (OpenStreetMap)
    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}`)
        .then(res => res.json())
        .then(data => {
            if (data.length > 0) {
                let lat = parseFloat(data[0].lat);
                let lon = parseFloat(data[0].lon);

                var map = L.map('map').setView([lat, lon], 14);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);

                L.marker([lat, lon]).addTo(map)
                    .bindPopup("{{ $facility->business_name }}<br>{{ $facility->street_address }}, {{ $facility->city }}")
                    .openPopup();
            } else {
                document.getElementById('map').innerHTML = "<p class='text-danger'>Address not found on map!</p>";
            }
        })
        .catch(err => {
            console.error(err);
            document.getElementById('map').innerHTML = "<p class='text-danger'>Map could not be loaded</p>";
        });
});
</script>
@endsection
