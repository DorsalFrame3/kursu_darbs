<?php
namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $user = auth()->user();
        
        $favoriteCharacterIds = DB::table('favorites')
        ->where('user_id', $user->id)
        ->where('favoritable_type', Character::class)
        ->pluck('favoritable_id')
        ->toArray();

        $locations = Location::all();
        return view('locations.index', compact('locations', 'favoriteLocationIds'));
    }

    public function create()
    {
        $this->authorize('create');
        return view('locations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'region' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            
        ],[
            'image.image' => 'The image field must be an image.',
            'image.mimes' => 'The image field must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image may not be greater than 2MB.',
        ]);

        $location = new Location();
        $location->name = $request->input('name');
        $location->description = $request->input('description');
        $location->region = $request->input('region');

        if ($request->hasFile('image')) {
            
            $image = $request->file('image');
            $imageName = $location->name . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public/image/', $imageName);
            $location->image = str_replace('public/', '', $imagePath);

        }
        $location->save();
        
        return redirect()->route('locations.index')->with('success', 'New location created successfully!');
    }

    
    public function show(Location $location)
    {
        return view('locations.show', compact('location'));
    }

    public function edit(Location $location)
    {
        $this->authorize('upd-del-location', $location);
        return view('locations.edit', compact('location'));
    }

    
    public function update(Request $request, Location $location)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'region' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],[
            'image.image' => 'The image field must be an image.',
            'image.mimes' => 'The image field must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image may not be greater than 2MB.',
        ]);
        
        $location->name = $request->input('name');
        $location->region = $request->input('region');
        $location->description = $request->input('description');

        if ($request->hasFile('image')) {
            
            if ($location->image) {
                Storage::disk('public')->delete($location->image);
            }

            $image = $request->file('image');
            $imageName = $location->name . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public/image/', $imageName); //'storage/app/public/image'
            $location->image = str_replace('public/', '', $imagePath);
        }
        $location->save();

        return redirect()->route('locations.index')->with('success', 'Location details updated successfully!');
    }

   
    public function destroy(Location $location)
    {
        $this->authorize('upd-del-location', $location);
        if ($location->image) {
            Storage::disk('public')->delete($location->image);
        }
        $location->delete();

        return redirect()->route('locations.index')->with('success', 'Location removed successfully!');
    }
}

