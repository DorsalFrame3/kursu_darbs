<?php
namespace App\Http\Controllers;

use App\Models\Weapon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WeaponController extends Controller
{
    public function index()
    {
        $weapons = Weapon::all();

        return view('weapons.index', compact('weapons'));
    }

    public function create()
    {
        return view('weapons.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            
        ],[
            'image.image' => 'The image field must be an image.',
            'image.mimes' => 'The image field must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image may not be greater than 2MB.',
        ]);

        $weapon = new Weapon();
        $weapon->name = $request->input('name');
        $weapon->description = $request->input('description');
        $weapon->type = $request->input('type');

        if ($request->hasFile('image')) {
            
            $image = $request->file('image');
            $imageName = $weapon->name . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public/image/', $imageName);
        }
        $weapon->save();
        
        return redirect()->route('weapons.index')->with('success', 'New weapon created successfully!');
    }

    
    public function show(Weapon $weapon)
    {
        return view('weapons.show', compact('weapon'));
    }

    public function edit(Weapon $weapon)
    {
        
        return view('weapons.edit', compact('weapon'));
    }

    
    public function update(Request $request, Weapon $weapon)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],[
            'image.image' => 'The image field must be an image.',
            'image.mimes' => 'The image field must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image may not be greater than 2MB.',
        ]);
        
        $weapon->name = $request->input('name');
        $weapon->description = $request->input('description');
        $weapon->type = $request->input('type');

        if ($request->hasFile('image')) {
            
            if ($weapon->image) {
                Storage::disk('public')->delete($weapon->image);
            }

            $image = $request->file('image');
            $imageName = $weapon->name . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public/image/', $imageName); //'storage/app/public/image'
        }
        $weapon->save();

        return redirect()->route('weapons.index')->with('success', 'Weapon details updated successfully!');
    }

   
    public function destroy(Weapon $weapon)
    {
        if ($weapon->image) {
            Storage::disk('public')->delete($weapon->image);
        }
        $weapon->delete();

        return redirect()->route('weapons.index')->with('success', 'Weapon removed successfully!');
    }
}
