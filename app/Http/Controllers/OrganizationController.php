<?php
namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

class OrganizationController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $user = auth()->user();
        
        $favoriteOrganizationIds = DB::table('favorites')
        ->where('user_id', $user->id)
        ->where('favoritable_type', Organization::class)
        ->pluck('favoritable_id')
        ->toArray();

        $organizations = Organization::all();
        return view('organizations.index', compact('organizations', 'favoriteOrganizationIds'));
    }

    public function create()
    {
        $this->authorize('create');
        return view('organizations.create');
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

        $organization = new Organization();
        $organization->name = $request->input('name');
        $organization->description = $request->input('description');
        $organization->type = $request->input('type');

        if ($request->hasFile('image')) {
            
            $image = $request->file('image');
            $imageName = $organization->name . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public/image/', $imageName); //'storage/app/public/image'
            $organization->image = str_replace('public/', '', $imagePath);
        }
        $organization->save();
        
        return redirect()->route('organizations.index')->with('success', 'New organization created successfully!');
    }

    
    public function show(Organization $organization)
    {
        $user = auth()->user();
        
        $favoriteOrganizationIds = DB::table('favorites')
        ->where('user_id', $user->id)
        ->where('favoritable_type', Organization::class)
        ->pluck('favoritable_id')
        ->toArray();
        return view('organizations.show', compact('organization', 'favoriteOrganizationIds'));
    }

    public function edit(organization $organization)
    {
        $this->authorize('upd-del-organization', $organization);
        return view('organizations.edit', compact('organization'));
    }

    
    public function update(Request $request, Organization $organization)
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
        
        $organization->name = $request->input('name');
        $organization->description = $request->input('description');
        $organization->type = $request->input('type');

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

   
    public function destroy(Organization $organization)
    {
        $this->authorize('upd-del-organization', $organization);
        if ($organization->image) {
            Storage::disk('public')->delete($organization->image);
        }
        $organization->delete();

        return redirect()->route('organizations.index')->with('success', 'Organization removed successfully!');
    }
}
