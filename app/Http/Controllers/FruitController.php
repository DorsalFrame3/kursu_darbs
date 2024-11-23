<?php
namespace App\Http\Controllers;

use App\Models\Fruit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

class FruitController extends Controller
{
    use AuthorizesRequests;
    
    public function index()
    {
        $user = auth()->user();
        
        $favoriteFruitIds = DB::table('favorites')
        ->where('user_id', $user->id)
        ->where('favoritable_type', Fruit::class)
        ->pluck('favoritable_id')
        ->toArray();

        $fruits = Fruit::all();
        return view('fruits.index', compact('fruits', 'favoriteFruitIds'));
    }

    public function create()
    {
        $this->authorize('create');
        return view('fruits.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|string|max:255',
            'power' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            
        ],[
            'image.image' => 'The image field must be an image.',
            'image.mimes' => 'The image field must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image may not be greater than 2MB.',
        ]);

        $fruit = new Fruit();
        $fruit->name = $request->input('name');
        $fruit->description = $request->input('description');
        $fruit->type = $request->input('type');
        $fruit->power = $request->input('power');

        if ($request->hasFile('image')) {
            
            $image = $request->file('image');
            $imageName = $fruit->name . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public/image/', $imageName); //'storage/app/public/image'
            $fruit->image = str_replace('public/', '', $imagePath);

        }
        $fruit->save();
        
        return redirect()->route('fruits.index')->with('success', 'New fruit created successfully!');
    }

    
    public function show(Fruit $fruit)
    {
        $user = auth()->user();
        
        $favoriteFruitIds = DB::table('favorites')
        ->where('user_id', $user->id)
        ->where('favoritable_type', Fruit::class)
        ->pluck('favoritable_id')
        ->toArray();
        return view('fruits.show', compact('fruit', 'favoriteFruitIds'));
    }

    public function edit(Fruit $fruit)
    {
        $this->authorize('upd-del-fruit', $fruit);
        return view('fruits.edit', compact('fruit'));
    }

    
    public function update(Request $request, Fruit $fruit)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|string|max:255',
            'power' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],[
            'image.image' => 'The image field must be an image.',
            'image.mimes' => 'The image field must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image may not be greater than 2MB.',
        ]);
        
        $fruit->name = $request->input('name');
        $fruit->description = $request->input('description');
        $fruit->type = $request->input('type');
        $fruit->power = $request->input('power');

        if ($request->hasFile('image')) {
            
            if ($fruit->image) {
                Storage::disk('public')->delete($fruit->image);
            }

            $image = $request->file('image');
            $imageName = $fruit->name . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public/image/', $imageName); //'storage/app/public/image'
            $fruit->image = str_replace('public/', '', $imagePath);
        }
        $fruit->save();

        return redirect()->route('fruits.index')->with('success', 'Fruit details updated successfully!');
    }

   
    public function destroy(Fruit $fruit)
    {
        $this->authorize('upd-del-fruit', $fruit);
        if ($fruit->image) {
            Storage::disk('public')->delete($fruit->image);
        }
        $fruit->delete();

        return redirect()->route('fruits.index')->with('success', 'Fruit removed successfully!');
    }
}
