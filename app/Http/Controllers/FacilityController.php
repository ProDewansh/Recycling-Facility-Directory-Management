<?php

// app/Http/Controllers/FacilityController.php
namespace App\Http\Controllers;
use App\Models\Facility;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class FacilityController extends Controller {

    // public function index(Request $request) {
    //     $query = Facility::with('materials');

    //     if ($request->search) {
    //         $query->where('business_name','like',"%$request->search%")
    //               ->orWhere('city','like',"%$request->search%");
    //     }

    //     if ($request->material_id) {
    //         $query->whereHas('materials', fn($q) => $q->where('id',$request->material_id));
    //     }

    //     if ($request->sort == 'last_update') {
    //         $query->orderBy('last_update_date','desc');
    //     }

    //     $facilities = $query->paginate(5);
    //     $materials = Material::all();

    //     return view('facilities.index', compact('facilities','materials'));
    // }

    public function index(Request $request) {
       
        $query = Facility::with('materials');
    
        // Search by business name or city
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('business_name','like',"%{$request->search}%")
                  ->orWhere('city','like',"%{$request->search}%");
            });
        }
    
        //  Filter by Material
        if ($request->material_id) {
            $query->whereHas('materials', function($q) use ($request) {
                $q->where('materials.id', $request->material_id);
            });
        }
    
        //  Sort
        if ($request->sort == 'last_update') {
            $query->orderBy('facilities.last_update_date','desc');
        } else {
            $query->orderBy('facilities.created_at','desc');
        }
    
        $facilities = $query->paginate(5)->withQueryString(); // preserve filters in pagination
        $materials = Material::all();
    
        return view('facilities.index', compact('facilities','materials'));
    }
    

    public function create() {
        $materials = Material::all();
        return view('facilities.create', compact('materials'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'business_name' => 'required|string',
            'last_update_date' => 'required|date',
            'street_address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'postal_code' => 'required|string',
            'materials' => 'array|required'
        ]);

        $facility = Facility::create($data);
        $facility->materials()->sync($request->materials);

        return redirect()->route('facilities.index')->with('success','Facility created successfully.');
    }

    public function edit(Facility $facility) {
        $materials = Material::all();
        return view('facilities.edit', compact('facility','materials'));
    }

    public function update(Request $request, Facility $facility) {
        $data = $request->validate([
            'business_name' => 'required|string',
            'last_update_date' => 'required|date',
            'street_address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'postal_code' => 'required|string',
            'materials' => 'array|required'
        ]);

        $facility->update($data);
        $facility->materials()->sync($request->materials);

        return redirect()->route('facilities.index')->with('success','Facility updated successfully.');
    }

    public function destroy(Facility $facility) {
        $facility->delete();
        return redirect()->route('facilities.index')->with('success','Facility deleted.');
    }

    public function show(Facility $facility) {
        
        return view('facilities.show', compact('facility'));
    }

    // public function exportCsv(Request $request) {
    //     $query = Facility::with('materials');
    //     if ($request->material_id) {
    //         $query->whereHas('materials', fn($q) => $q->where('id',$request->material_id));
    //     }
    //     $facilities = $query->get();

    //     $csv = "Business Name,Last Updated,Address,Materials\n";
    //     foreach ($facilities as $f) {
    //         $materials = $f->materials->pluck('name')->join(", ");
    //         $csv .= "{$f->business_name},{$f->last_update_date},{$f->street_address} {$f->city} {$f->state} {$f->postal_code},$materials\n";
    //     }

    //     return Response::make($csv,200,[
    //         'Content-Type' => 'text/csv',
    //         'Content-Disposition' => 'attachment; filename="facilities.csv"'
    //     ]);
    // }

    // public function exportCsv(Request $request) {
    //     $query = Facility::with('materials');
    
    //     if ($request->material_id) {
    //         $query->whereHas('materials', fn($q) => $q->where('materials.id',$request->material_id));
    //     }
    
    //     $facilities = $query->get();
    
    //     // Output buffering
    //     $output = fopen('php://output', 'w');
    
    //     // Send headers for CSV download
    //     header('Content-Type: text/csv');
    //     header('Content-Disposition: attachment; filename="facilities.csv"');
    
    //     // Write header row
    //     fputcsv($output, ['Business Name','Last Updated','Address','Materials']);
    
    //     // Write data rows
    //     foreach ($facilities as $f) {
    //         $address = "{$f->street_address}, {$f->city}, {$f->state} {$f->postal_code}";
    //         $materials = $f->materials->pluck('name')->join(", ");
    
    //         fputcsv($output, [
    //             $f->business_name,
    //             $f->last_update_date,
    //             $address,
    //             $materials
    //         ]);
    //     }
    
    //     fclose($output);
    //     exit;
    // }

    public function exportCsv(Request $request)
{
    
    $query = Facility::with('materials');

    if ($request->search) {
        $query->where(function($q) use ($request) {
            $q->where('business_name', 'like', "%{$request->search}%")
              ->orWhere('city', 'like', "%{$request->search}%");
        });
    }

    
    if ($request->material_id) {
        $query->whereHas('materials', function($q) use ($request) {
            $q->where('materials.id', $request->material_id);
        });
    }

    if ($request->sort == 'last_update') {
        $query->orderBy('facilities.last_update_date', 'desc');
    } else {
        $query->orderBy('facilities.created_at', 'desc');
    }

    //  Get all filtered results
    $facilities = $query->get();

    // CSV download 
    $filename = 'facilities_export_' . now()->format('Ymd_His') . '.csv';

    // Create a streamed response for efficient CSV download
    return response()->streamDownload(function() use ($facilities) {
        $output = fopen('php://output', 'w');

        // Header row
        fputcsv($output, ['Business Name', 'Last Updated', 'Address', 'Materials']);

        // Data rows
        foreach ($facilities as $f) {
            $address = "{$f->street_address}, {$f->city}, {$f->state} {$f->postal_code}";
            $materials = $f->materials->pluck('name')->join(", ");

            fputcsv($output, [
                $f->business_name,
                $f->last_update_date,
                $address,
                $materials
            ]);
        }

        fclose($output);
    }, $filename, [
        'Content-Type' => 'text/csv',
    ]);
}

    
}
