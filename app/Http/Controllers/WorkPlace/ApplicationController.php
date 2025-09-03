<?php

namespace App\Http\Controllers\WorkPlace;

use App\Http\Controllers\Controller;
use App\Models\Applications;
use App\Models\ApplicationType;
use App\Models\PageContents;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contents = PageContents::all();
        $sortedMenu = collect($contents['0']->items['menu'])->sortBy('order');
        $applicationTypes = ApplicationType::all();

        return view('web.pages.applications.index', compact('contents', 'sortedMenu', 'applicationTypes'));
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
        //
    }

    public function get(string $id)
    {
        $application = Applications::find($id);

        if (!$application) {
            return response()->json(['message' => 'Application not found'], 404);
        }
        return response()->json($application, 200);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getTab($tab)
    {
        $applications = Applications::select('id', 'name', 'url', 'status', 'visitor_count', 'visibility', 'icon', 'created_at')->where('type', $tab)->get();
        $publicApplicationsCount = Applications::where('visibility', 'public')->where('type', $tab)->exists();
        $mostVisitedApplication = Applications::select('id', 'name', 'url', 'status', 'visitor_count', 'visibility', 'icon', 'created_at')->where('type', $tab)->orderBy('visitor_count', 'desc')->first();
        $content = view('web.pages.applications.tabs', compact('applications', 'publicApplicationsCount', 'mostVisitedApplication'))->render();
        return response()->json(['html' => $content]);
    }

    public function render($url)
    {
        $app = Applications::where('url', $url)->first();
        $codes = $app->codes;
        $name = $app->name;

        if ($app->visibility == 'private' || $app->status == 'working_on_it') {
            return view('web.pages.applications.applications-here.unavailableApplication');
        }

        if (request()->query('visited_click') !== 'true') {
            $app->visitor_count = $app->visitor_count + 1;
            $app->save();
        }

        if (is_string($codes)) {
            $codes = json_decode($codes, true);
        }

        return view('web.pages.applications.applications-here.application_code', compact('codes', 'name'));
    }

    public function count($id)
    {
        $app = Applications::find($id);
        $app->visitor_count = $app->visitor_count + 1;
        $app->save();
        return response()->json(['message' => 'success']);
    }
}
