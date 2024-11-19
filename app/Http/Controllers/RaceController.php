<?php

namespace App\Http\Controllers;

use App\Models\Race;
use Illuminate\Http\Request;

class RaceController extends Controller
{
    public function index()
    {
        $races = Race::all();

        return view('races.index', compact('races'));
    }

    public function create()
    {
        return view('races.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            
        ],[
            'image.image' => 'The image field must be an image.',
            'image.mimes' => 'The image field must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image may not be greater than 2MB.',
        ]);

        $race = new Race();
        $race->name = $request->input('name');
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
        return view('races.show', compact('race'));
    }

    public function edit(Race $race)
    {
        
        return view('races.edit', compact('race'));
    }

    
    public function update(Request $request, Race $race)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],[
            'image.image' => 'The image field must be an image.',
            'image.mimes' => 'The image field must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image may not be greater than 2MB.',
        ]);
        
        $race->name = $request->input('name');
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
        if ($race->image) {
            Storage::disk('public')->delete($race->image);
        }
        $race->delete();

        return redirect()->route('races.index')->with('success', 'Race removed successfully!');
    }
}

