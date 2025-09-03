<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\PageContents;
use App\Models\Tips;
use App\Models\User;
use App\Services\DeviceInfoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LandingController extends Controller
{
    protected $device;

    public function __construct(DeviceInfoService $device)
    {
        $this->device = $device;
    }

    public function index()
    {
        return view('web.landing.index');
    }

    public function form(Request $request)
    {

        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'age' => 'required|integer|min:10|max:60',
            'school' => 'nullable|string|max:255',
            'futureExpertise' => 'nullable|string|max:255',
            'education' => 'nullable|in:high_school,college,graduate',
            'university' => 'nullable|string|max:255',
            'occupation' => 'nullable|string|max:255',
            'interests' => 'nullable|array',
            'interests.*' => 'string',
            'contact_preferences' => 'required|array',
            'contact_preferences.*' => 'in:whatsapp,group,email,no_contact',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $deviceInfo = $this->device->getDeviceInfo($request);

        $user = new User();

        // Explicitly set each field
        $user->first_name = $request->input('firstName');
        $user->last_name = $request->input('lastName');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->age = $request->input('age');
        $user->school = $request->input('school');
        $user->future_expertise = $request->input('futureExpertise');
        $user->education = $request->input('education');
        $user->university = $request->input('university');
        $user->occupation = $request->input('occupation');

        // Convert arrays to JSON strings before saving
        $user->interests = json_encode($request->input('interests'));
        $user->contact_preferences = json_encode($request->input('contact_preferences'));

        // Fill device info
        $user->fill($deviceInfo);

        $user->save();

        return redirect()->back()->with('success', __('form.thank_you'));
    }

    public function tips($slug)
    {
        $contents = PageContents::all();
        $sortedMenu = collect($contents->first()->items['menu'])->sortBy('order');

        $tips = new Tips();
        $selectedCards = $tips->randomCards($slug);

        $viewName = 'web.landing.pages.tips.' . Str::camel($slug);

        if (view()->exists($viewName)) {
            return view($viewName, compact('contents', 'sortedMenu', 'selectedCards'));
        }

        abort(404);
    }

    public function contact(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:500',
        ]);

        Feedback::create($validatedData);

        return response()->json(['message' => 'Feedback submitted successfully', 'success' => true]);
    }

    // Uncomment and implement if needed
    /*
    public function removeBackground(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:2048', // Add max file size
        ]);

        $file = $request->file('file');
        $filePath = $file->getPathname();

        $secretKey = config('services.background_removal.secret_key');

        // Use Laravel's HTTP client instead of the global Http facade
        $response = \Illuminate\Support\Facades\Http::withHeaders([
            'X-Api-Key' => $secretKey
        ])->attach(
            'file',
            file_get_contents($filePath),
            $file->getClientOriginalName()
        )->post(config('services.background_removal.api_url'));

        if ($response->failed()) {
            return response()->json(['error' => 'Error processing the image.'], 500);
        }

        return response($response->body(), 200)->header('Content-Type', 'image/png');
    }
    */
}
