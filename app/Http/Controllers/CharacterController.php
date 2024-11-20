<?php
namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CharacterController extends Controller
{
    public function index()
    {
        $characters = Character::all();

        return view('characters.index', compact('characters'));
    }

    public function create()
    {
        if (Gate::denies('create-character', Character::class)) {
            abort(403, 'Access denied');
        }

        return view('characters.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'bounty' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            
        ],[
            'image.image' => 'The image field must be an image.',
            'image.mimes' => 'The image field must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image may not be greater than 2MB.',
        ]);

        $character = new Character();
        $character->name = $request->input('name');
        $character->description = $request->input('description');
        $character->bounty = $request->input('bounty');

        if ($request->hasFile('image')) {
            
            $image = $request->file('image');
            $imageName = $character->name . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public/image', $imageName); //'storage/app/public/image'
            $character->image = str_replace('public/', '', $imagePath);
        }
        $character->save();
        
        return redirect()->route('characters.index')->with('success', 'New character created successfully!');
    }

    
    public function show(Character $character)
    {
        return view('characters.show', compact('character'));
    }

    public function edit(Character $character)
    {
        $this->authorize('update-character', $character);
        return view('characters.edit', compact('character'));
    }

    
    public function update(Request $request, Character $character)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'bounty' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],[
            'image.image' => 'The image field must be an image.',
            'image.mimes' => 'The image field must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image may not be greater than 2MB.',
        ]);
        
        $character->name = $request->input('name');
        $character->description = $request->input('description');
        $character->bounty = $request->input('bounty');

        if ($request->hasFile('image')) {
            
            if ($character->image) {
                Storage::disk('public')->delete($character->image);
            }

            $image = $request->file('image');
            $imageName = $character->name . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public/image', $imageName); //'storage/app/public/image'
            $character->image = str_replace('public/', '', $imagePath);
        }
        $character->save();

        return redirect()->route('characters.index')->with('success', 'Character details updated successfully!');
    }

   
    public function destroy(Character $character)
    {
        if ($character->image) {
            Storage::disk('public')->delete($character->image);
        }
        $character->delete();
        
        return redirect()->route('characters.index')->with('success', 'Character removed successfully!');
    }
}
