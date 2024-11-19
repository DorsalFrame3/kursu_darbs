<?php
namespace App\Http\Controllers;

use App\Models\Fruit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FruitController extends Controller
{
    public function index()
    {
        $fruits = Fruit::all();

        return view('fruits.index', compact('fruits'));
    }

    public function create()
    {
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
        return view('fruits.show', compact('fruit'));
    }

    public function edit(Fruit $fruit)
    {
        
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
        if ($fruit->image) {
            Storage::disk('public')->delete($fruit->image);
        }
        $fruit->delete();

        return redirect()->route('fruits.index')->with('success', 'Fruit removed successfully!');
    }
}
