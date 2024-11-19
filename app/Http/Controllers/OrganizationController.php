<?php
namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrganizationController extends Controller
{
    public function index()
    {
        $organizations = Organization::all();

        return view('organizations.index', compact('organizations'));
    }

    public function create()
    {
        return view('organizations.create');
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

        $organization = new Organization();
        $organization->name = $request->input('name');
        $organization->description = $request->input('description');

        if ($request->hasFile('image')) {
            
            $image = $request->file('image');
            $imageName = $organization->name . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public/image/', $imageName); //'storage/app/public/image'
            $organization->image = str_replace('public/', '', $imagePath);
        }
        $organization->save();
        
        return redirect()->route('organizations.index')->with('success', 'New organization created successfully!');
    }

    
    public function show(organization $organization)
    {
        return view('organizations.show', compact('organization'));
    }

    public function edit(organization $organization)
    {
        
        return view('organizations.edit', compact('organization'));
    }

    
    public function update(Request $request, organization $organization)
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
        
        $organization->name = $request->input('name');
        $organization->description = $request->input('description');

        if ($request->hasFile('image')) {
            
            if ($organization->image) {
                Storage::disk('public')->delete($organization->image);
            }

            $image = $request->file('image');
            $imageName = $organization->name . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public/image/', $imageName); //'storage/app/public/image'
            $organization->image = str_replace('public/', '', $imagePath);
        }
        $organization->save();

        return redirect()->route('organizations.index')->with('success', 'Organization details updated successfully!');
    }

   
    public function destroy(organization $organization)
    {
        if ($organization->image) {
            Storage::disk('public')->delete($organization->image);
        }
        $organization->delete();

        return redirect()->route('organizations.index')->with('success', 'Organization removed successfully!');
    }
}