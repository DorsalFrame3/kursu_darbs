<?php
namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

class CharacterController extends Controller
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
        $characters = Character::all();
        return view('characters.index', compact('characters', 'favoriteCharacterIds'));
    }

    public function create()
    {
        $this->authorize('create');
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
        $user = auth()->user();
        
        $favoriteCharacterIds = DB::table('favorites')
        ->where('user_id', $user->id)
        ->where('favoritable_type', Character::class)
        ->pluck('favoritable_id')
        ->toArray();
        return view('characters.show', compact('character', 'favoriteCharacterIds'));
    }

    public function edit(Character $character)
    {
        $this->authorize('upd-del-character', $character);
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
        $this->authorize('upd-del-character', $character);
        if ($character->image) {
            Storage::disk('public')->delete($character->image);
        }
        $character->delete();
        
        return redirect()->route('characters.index')->with('success', 'Character removed successfully!');
    }
}
