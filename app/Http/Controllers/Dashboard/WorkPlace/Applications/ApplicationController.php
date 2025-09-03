<?php

namespace App\Http\Controllers\Dashboard\WorkPlace\Applications;

use App\Http\Controllers\Controller;
use App\Models\Applications;
use App\Models\ApplicationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $application = Applications::all();
        $user = auth()->user();

        $iconPath = public_path('vendor/img/lebify/application-icon');
        $iconFiles = File::files($iconPath);
        $iconNames = array_map(function ($file) {
            return pathinfo($file, PATHINFO_FILENAME);
        }, $iconFiles);
        $applicationTypes = ApplicationType::all();

        return view('web.dashboard.pages.workPlace.applications.application', compact('application', 'user', 'iconNames', 'applicationTypes'));
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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'developer_name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'url' => 'required|max:255',
            'features' => 'required',
            'icon' => 'required',
            'description' => 'required|string',
        ]);

        $type = ApplicationType::where('identifier', $request->type)->first();
        $type->application_count++;
        $type->save();

        $html = $request->html;
        $css = $request->css;
        $js = $request->js;

        $codes = [
            'html' => $html,
            'css' => $css,
            'js' => $js
        ];

        $application = new Applications();
        $application->name = $request->name;
        $application->type = $request->type;
        $application->url = $request->url;
        $application->features = $request->features;
        $application->description = $request->description;
        $application->icon = $request->icon;
        $application->developer_name = $request->developer_name;
        $application->visibility = $request->visibility ?? 'private';
        $application->status = $request->status ?? 'working_on_it';
        $application->codes = json_encode($codes);
        $application->save();

        // Return a JSON response
        return response()->json([
            'success' => true,
            'message' => 'Application created successfully',
            'data' => $application
        ], 201);
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

    public function datatable(Request $request)
    {
        $search = request()->get('search');
        $value = isset($search['value']) ? $search['value'] : null;

        $applications = Applications::select(
            'id',
            'name',
            'type',
            'url',
            'icon',
            'visibility',
            'status',
            'created_at'
        )
            ->when($value, function ($query) use ($value) {
                return $query->where(function ($query) use ($value) {
                    $query->where('name', 'like', '%' . $value . '%')
                        ->orWhere('type', 'like', '%' . $value . '%')
                        ->orWhere('url', 'like', '%' . $value . '%')
                        ->orWhere('visibility', 'like', '%' . $value . '%')
                        ->orWhere('status', 'like', '%' . $value . '%');
                });
            });

        return DataTables::of($applications->get())
            ->editColumn('created_at', function ($application) {
                return $application->created_at->diffForHumans();
            })->make(true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $application = Applications::find($id);
        $application->delete();

        return response()->json(['success' => true, 'message' => 'Application deleted successfully']);
    }

    public function get(string $id)
    {
        $application = Applications::find($id);

        if (!$application) {
            return response()->json(['message' => 'Application not found'], 404);
        }
        $application->codes = json_decode($application->codes, true);

        return response()->json($application);
    }

    public function changeVisibility(string $id)
    {
        $application = Applications::find($id);
        $application->visibility = $application->visibility == 'public' ? 'private' : 'public';
        $application->save();
        return response()->json(['success' => true, 'message' => 'Application visibility updated successfully']);
    }

    public function changeStatus(string $id)
    {
        $application = Applications::find($id);
        $application->status = $application->status == 'working_on_it' ? 'available' : 'working_on_it';
        $application->save();
        return response()->json(['success' => true, 'message' => 'Application status updated successfully']);
    }

    public function editApplication(Request $request)
    {

        $oldType = Applications::find($request->id)->type;
        $newType = $request->type;

        if ($newType !== $oldType) {
            $oldType = ApplicationType::where('identifier', $oldType)->first();
            $oldType->application_count--;
            $oldType->save();

            $newType = ApplicationType::where('identifier', $newType)->first();
            $newType->application_count++;
            $newType->save();
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'developer_name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'url' => 'required|max:255',
            'features' => 'required',
            'description' => 'required|string',
        ]);

        $html = $request->html;
        $css = $request->css;
        $js = $request->js;

        $codes = [
            'html' => $html,
            'css' => $css,
            'js' => $js
        ];

        $validator->validate();
        $application = Applications::find($request->id);
        $application->name = $request->name;
        $application->type = $request->type;
        $application->url = $request->url;
        $application->features = $request->features;
        $application->description = $request->description;
        $application->icon = $request->icon;
        $application->developer_name = $request->developer_name;
        $application->codes = json_encode($codes);
        $application->save();
        return response()->json(['success' => true, 'message' => 'Application updated successfully', $codes]);
    }

    // public function createFiles(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'html' => 'required|string',
    //         'css' => 'required|string',
    //         'js' => 'required|string',
    //         'appName' => 'required|string|max:regex:/^[a-zA-Z0-9-_]+$/'
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['errors' => $validator->errors()], 422);
    //     }

    //     $appName = $request->appName;

    //     $htmlFilePath = resource_path('views/web/pages/applications/applications-here/' . $appName . '.blade.php');
    //     $cssFilePath = public_path('css/applicationsCss/' . $appName . '.css');
    //     $jsFilePath = public_path('js/applicationsJs/' . $appName . '.js');

    //     if (File::exists($htmlFilePath) || File::exists($cssFilePath) || File::exists($jsFilePath)) {
    //         return response()->json(['error' => 'Application with this name already exists'], 500);
    //     }

    //     $htmlFile = $request->html;
    //     $cssFile = $request->css;
    //     $jsFile = $request->js;

    //     $dom = new \DOMDocument();
    //     @$dom->loadHTML($htmlFile, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

    //     $links = $dom->getElementsByTagName('link');
    //     foreach ($links as $link) {
    //         if ($link->getAttribute('href') == 'index.css') {
    //             $link->setAttribute('href', "{{ asset('css/applicationsCss/$appName.css') }}");
    //         }
    //     }

    //     $scripts = $dom->getElementsByTagName('script');
    //     foreach ($scripts as $script) {
    //         if ($script->getAttribute('src') == 'index.js') {
    //             $script->setAttribute('src', "{{ asset('js/applicationsJs/$appName.js') }}");
    //         }
    //     }

    //     $htmlFile = $dom->saveHTML();

    //     try {
    //         File::put($htmlFilePath, $htmlFile);
    //         File::put($cssFilePath, $cssFile);
    //         File::put($jsFilePath, $jsFile);
    //     } catch (\Exception $e) {
    //         return response()->json(['message' => 'Failed to create files: ' . $e->getMessage()], 500);
    //     }

    //     if (!File::exists($htmlFilePath) || !File::exists($cssFilePath) || !File::exists($jsFilePath)) {
    //         return response()->json(['message' => 'Failed to create one or more files'], 500);
    //     }

    //     return response()->json(['success' => true, 'cssFile' => $cssFile, 'jsFile' => $jsFile, 'htmlFile' => $htmlFile]);
    // }

    public function uploadIcon(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'icon' => 'required|image|mimes:png|max:2048',
            'name' => 'required|string|max:255',
        ]);

        $validator->validate();

        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $name = $request->input('name');
            $extension = $icon->getClientOriginalExtension();
            $fileName = $name . '.' . $extension;

            $path = public_path('vendor/img/lebify/application-icon');
            $filePath = $path . '/' . $fileName;

            if (File::exists($filePath)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Icon with this name already exists'
                ], 500);
            }

            try {
                $icon->move($path, $fileName);

                return response()->json([
                    'success' => true,
                    'message' => 'Icon uploaded successfully',
                    'icon_name' => $name
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to upload icon: ' . $e->getMessage()
                ], 500);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'No icon file provided'
        ], 400);
    }

    public function deleteIcon($icon)
    {
        $path = public_path('vendor/img/lebify/application-icon/' . $icon . '.png');

        if (File::exists($path)) {
            if (File::delete($path)) {
                return response()->json(['success' => true, 'message' => 'Icon deleted successfully']);
            } else {
                return response()->json(['success' => false, 'message' => 'Failed to delete the icon'], 500);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Icon not found'], 404);
        }
    }
}
