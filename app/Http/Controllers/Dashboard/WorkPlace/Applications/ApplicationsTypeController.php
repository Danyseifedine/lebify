<?php

namespace App\Http\Controllers\Dashboard\WorkPlace\Applications;

use App\Http\Controllers\Controller;
use App\Models\ApplicationType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ApplicationsTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $applicationTypes = ApplicationType::all();

        return view('web.dashboard.pages.workPlace.applications.applicationType', compact('user', 'applicationTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'identifier' => 'required|string|max:255',
        ]);

        $applicationType = ApplicationType::create($request->all());

        return response()->json(['success' => true, 'message' => 'Application type created successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function editApplicationType(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'identifier' => 'required|string|max:255',
        ]);

        $applicationType = ApplicationType::find($request->id);

        // Check if label or identifier already exist
        $existingLabel = ApplicationType::where('label', $request->label)
            ->where('id', '!=', $request->id)
            ->first();

        $existingIdentifier = ApplicationType::where('identifier', $request->identifier)
            ->where('id', '!=', $request->id)
            ->first();

        if ($existingLabel) {
            return response()->json(['error' => 'Label already exists'], 500);
        }

        if ($existingIdentifier) {
            return response()->json(['error' => 'Identifier already exists'], 500);
        }

        $applicationType->update($request->all());

        return response()->json(['success' => true, 'message' => 'Application type updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $applicationType = ApplicationType::find($id);
        $applicationType->delete();

        return response()->json(['success' => true, 'message' => 'Application type deleted successfully']);
    }

    public function datatable()
    {
        $search = request()->get('search');
        $value = isset($search['value']) ? $search['value'] : null;

        $applicationtypes = ApplicationType::select(
            'id',
            'label',
            'identifier',
            'application_count',
            'created_at'
        )
            ->when($value, function ($query) use ($value) {
                return $query->where(function ($query) use ($value) {
                    $query->where('label', 'like', '%' . $value . '%')
                        ->orWhere('identifier', 'like', '%' . $value . '%')
                        ->orWhere('application_count', 'like', '%' . $value . '%');
                });
            });

        return DataTables::of($applicationtypes->get())
            ->editColumn('created_at', function ($applicationtype) {
                return $applicationtype->created_at->diffForHumans();
            })->make(true);
    }

    public function get(string $id)
    {
        $applicationType = ApplicationType::find($id);
        return response()->json($applicationType);
    }
}
