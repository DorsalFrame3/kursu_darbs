<?php

namespace App\Http\Controllers;

use App\Models\Race;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

class RaceController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $user = auth()->user();
        
        $favoriteRaceIds = DB::table('favorites')
        ->where('user_id', $user->id)
        ->where('favoritable_type', Race::class)
        ->pluck('favoritable_id')
        ->toArray();

        $races = Race::all();
        return view('races.index', compact('races', 'favoriteRaceIds'));
    }

    public function create()
    {
        $this->authorize('create');
        return view('races.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'feature' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            
        ],[
            'image.image' => 'The image field must be an image.',
            'image.mimes' => 'The image field must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image may not be greater than 2MB.',
        ]);

        $race = new Race();
        $race->name = $request->input('name');
        $race->feature = $request->input('feature');
        $race->description = $request->input('description');

        if ($request->hasFile('image')) {
            
            $image = $request->file('image');
            $imageName = $race->name . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public/image/', $imageName); //'storage/app/public/image'
            $race->image = str_replace('public/', '', $imagePath);
        }
        $race->save();
        
        return redirect()->route('races.index')->with('success', 'New race created successfully!');
    }

    
    public function show(Race $race)
    {
        $user = auth()->user();
        
        $favoriteRaceIds = DB::table('favorites')
        ->where('user_id', $user->id)
        ->where('favoritable_type', Race::class)
        ->pluck('favoritable_id')
        ->toArray();
        return view('races.show', compact('race', 'favoriteRaceIds'));
    }

    public function edit(Race $race)
    {
        $this->authorize('upd-del-race', $race);
        return view('races.edit', compact('race'));
    }

    
    public function update(Request $request, Race $race)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'feature' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],[
            'image.image' => 'The image field must be an image.',
            'image.mimes' => 'The image field must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image may not be greater than 2MB.',
        ]);
        
        $race->name = $request->input('name');
        $race->feature = $request->input('feature');
        $race->description = $request->input('description');

        if ($request->hasFile('image')) {
            
            if ($race->image) {
                Storage::disk('public')->delete($race->image);
            }

            $image = $request->file('image');
            $imageName = $race->name . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public/image/', $imageName); //'storage/app/public/image'
            $race->image = str_replace('public/', '', $imagePath);
        }
        $race->save();

        return redirect()->route('races.index')->with('success', 'Race details updated successfully!');
    }

   
    public function destroy(Race $race)
    {
        $this->authorize('upd-del-race', $race);
        if ($race->image) {
            Storage::disk('public')->delete($race->image);
        }
        $race->delete();

        return redirect()->route('races.index')->with('success', 'Race removed successfully!');
    }
}

