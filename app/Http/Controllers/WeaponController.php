<?php
namespace App\Http\Controllers;

use App\Models\Weapon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

class WeaponController extends Controller
{
    use AuthorizesRequests;
    
    public function index()
    {
        $user = auth()->user();
        
        $favoriteWeaponIds = DB::table('favorites')
        ->where('user_id', $user->id)
        ->where('favoritable_type', Weapon::class)
        ->pluck('favoritable_id')
        ->toArray();

        $weapons = Weapon::all();
        return view('weapons.index', compact('weapons', 'favoriteWeaponIds'));
    }

    public function create()
    {
        $this->authorize('create');
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
            $weapon->image = str_replace('public/', '', $imagePath);
        }
        $weapon->save();
        
        return redirect()->route('weapons.index')->with('success', 'New weapon created successfully!');
    }

    
    public function show(Weapon $weapon)
    {
        $user = auth()->user();
        
        $favoriteWeaponIds = DB::table('favorites')
        ->where('user_id', $user->id)
        ->where('favoritable_type', Weapon::class)
        ->pluck('favoritable_id')
        ->toArray();
        return view('weapons.show', compact('weapon', 'favoriteWeaponIds'));
    }

    public function edit(Weapon $weapon)
    {
        $this->authorize('upd-del-weapon', $weapon);
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
            $weapon->image = str_replace('public/', '', $imagePath);
        }
        $weapon->save();

        return redirect()->route('weapons.index')->with('success', 'Weapon details updated successfully!');
    }

   
    public function destroy(Weapon $weapon)
    {
        $this->authorize('upd-del-weapon', $weapon);
        if ($weapon->image) {
            Storage::disk('public')->delete($weapon->image);
        }
        $weapon->delete();

        return redirect()->route('weapons.index')->with('success', 'Weapon removed successfully!');
    }
}
