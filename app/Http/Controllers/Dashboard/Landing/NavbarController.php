<?php

namespace App\Http\Controllers\Dashboard\Landing;

use App\Http\Controllers\Controller;
use App\Models\PageContents;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class NavbarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $navbar = PageContents::where('type', 'navbar')->first();
        $user = auth()->user();

        // Since you're using casts, $navbar->items is already an array
        $logo = $navbar->items['logo'] ?? null;
        $theme = $navbar->items['theme'] ?? null;

        return view('web.dashboard.pages.landing.navbar', compact('user', 'navbar', 'logo', 'theme'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'label' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'order' => 'required|integer|min:1',
        ]);

        $validator->validate();

        $navbar = PageContents::where('type', 'navbar')->first();

        if (!$navbar) {
            return response()->json(['message' => 'Navbar not found'], 404);
        }

        $items = $navbar->items;
        $menuItems = $items['menu'];

        $newId = count($menuItems) > 0 ? max(array_column($menuItems, 'id')) + 1 : 1;

        $newItem = [
            'id' => $newId,
            'label' => $request->label,
            'url' => $request->url,
            'visibility' => $request->visibility,
            'order' => $request->order,
        ];

        $menuItems[] = $newItem;

        $items['menu'] = $menuItems;
        $navbar->items = $items;
        $navbar->save();

        return response()->json(['message' => 'Menu item added successfully', 'item' => $newItem], 201);
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
    public function updateNavbarMenu(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'label' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'order' => 'required|integer|min:1',
        ]);

        $validator->validate();

        $navbar = PageContents::where('type', 'navbar')->first();

        if (!$navbar) {
            return response()->json(['message' => 'Navbar not found'], 404);
        }

        $items = $navbar->items;
        $menuItems = $items['menu'];

        $updatedItem = null;
        foreach ($menuItems as &$item) {
            if ($item['id'] == $request->id) {
                $item['label'] = $request->label;
                $item['url'] = $request->url;
                $item['order'] = $request->order;
                $updatedItem = $item;
                break;
            }
        }

        if (!$updatedItem) {
            return response()->json(['message' => 'Menu item not found'], 404);
        }

        $items['menu'] = $menuItems;
        $navbar->items = $items;
        $navbar->save();

        return response()->json(['message' => 'Menu item updated successfully', 'item' => $updatedItem], 200);
    }

    public function get(string $id)
    {
        $navbar = PageContents::where('type', 'navbar')->first();

        if (!$navbar) {
            return response()->json(['message' => 'Navbar not found'], 404);
        }

        $menuItems = $navbar->items['menu'];

        $item = collect($menuItems)->firstWhere('id', $id);

        if (!$item) {
            return response()->json(['message' => 'Menu item not found'], 404);
        }

        return response()->json($item, 200);
    }

    /*
    |--------------------------------------------------------------------------
    | Destroy
    |--------------------------------------------------------------------------
    */
    public function destroy(string $id)
    {
        $navbar = PageContents::where('type', 'navbar')->first();

        if (!$navbar) {
            return response()->json(['message' => 'Navbar not found'], 404);
        }

        $items = $navbar->items;
        $menuItems = $items['menu'];
        $itemRemoved = false;

        foreach ($menuItems as $key => $item) {
            if ($item['id'] == $id) {
                unset($menuItems[$key]);
                $itemRemoved = true;
                break;
            }
        }

        if ($itemRemoved) {
            $items['menu'] = array_values($menuItems);
            $navbar->items = $items;
            $navbar->save();
            return response()->json(['message' => 'Menu item removed successfully'], 200);
        } else {
            return response()->json(['message' => 'Menu item not found'], 404);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Datatable
    |--------------------------------------------------------------------------
    */
    public function datatable(Request $request)
    {
        $search = request()->get('search');
        $value = isset($search['value']) ? $search['value'] : null;

        $navbars = PageContents::where('type', 'navbar')
            ->get()
            ->flatMap(function ($content) {
                return collect($content->items['menu'] ?? [])->map(function ($item, $key) use ($content) {
                    return [
                        'id' => $item['id'],
                        'label' => $item['label'],
                        'url' => $item['url'],
                        'visibility' => $item['visibility'],
                        'order' => $item['order'],
                    ];
                });
            });

        if ($value) {
            $navbars = $navbars->filter(function ($item) use ($value) {
                return Str::contains($item['label'], $value) ||
                    Str::contains($item['url'], $value) ||
                    Str::contains((string)$item['order'], $value) ||
                    Str::contains((string)$item['visibility'], $value);
            });
        }

        return DataTables::of($navbars)->make(true);
    }



    /*
    |--------------------------------------------------------------------------
    | Change Visibility
    |--------------------------------------------------------------------------
    */
    public function changeVisibility($id)
    {
        $navbar = PageContents::where('type', 'navbar')->first();

        if (!$navbar) {
            return response()->json(['message' => 'Navbar not found'], 404);
        }

        $items = $navbar->items;
        $updated = false;

        foreach ($items['menu'] as $key => &$item) {
            if ($item['id'] == $id) {
                $item['visibility'] = !$item['visibility'];
                $updated = true;
                break;
            }
        }

        if ($updated) {
            $navbar->items = $items;
            $navbar->save();
            return response()->json(['message' => 'Visibility toggled successfully'], 200);
        } else {
            return response()->json(['message' => 'Menu item not found'], 404);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Update Logo
    |--------------------------------------------------------------------------
    */
    public function updateLogo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'alt' => 'required|string|max:255',
            'url' => 'required|string|max:255',
        ]);

        $validator->validate();

        $navbar = PageContents::where('type', 'navbar')->first();

        $items = $navbar->items;
        $items['logo']['alt'] = $request->alt;
        $items['logo']['url'] = $request->url;
        $items['logo']['visibility'] = $request->visibility == 1 ? true : false;
        $navbar->items = $items;
        $navbar->save();

        return response()->json(['message' => 'Logo updated successfully'], 200);
    }

    /*
    |--------------------------------------------------------------------------
    | Update Theme
    |--------------------------------------------------------------------------
    */
    public function updateTheme(Request $request)
    {
        $navbar = PageContents::where('type', 'navbar')->first();
        $items = $navbar->items;
        $items['theme']['visibility'] = $request->visibility == '1' ? true : false;
        $items['theme']['default'] = $request->default;
        $navbar->items = $items;
        $navbar->save();

        return response()->json(['message' => 'Theme updated successfully'], 200);
    }
}
