<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Character;
use App\Models\Fruit;
use App\Models\Weapon;
use App\Models\Location;
use App\Models\Organization;
use App\Models\Race;

class FavoriteController extends Controller
{
    public function addToFavorites(Request $request, $type)
    {
        $user = auth()->user();
        $modelClass = $this->resolveModelClass($type);
        $model = $modelClass::find($request->id);
    
        if ($model) {
            $user->{$type}()->syncWithoutDetaching($model); 
            return redirect()->back()->with('success', ucfirst($type) . ' added to favorites!');
        }
    
        return redirect()->back()->with('error', ucfirst($type) . ' not found!');
    }

    public function removeFromFavorites(Request $request, $type, $id)
    {
        $user = auth()->user();

        $modelClass = $this->resolveModelClass($type);
        $model = $modelClass::find($id);

        if ($model) {
            $user->{$type}()->detach($model);
            return redirect()->back()->with('success', ucfirst($type) . ' removed from favorites!');
        }

        return redirect()->back()->with('error', ucfirst($type) . ' not found!');
    }

    public function showFavorites()
    {
        $user = auth()->user();

        $favorites = collect()
            ->merge($user->characters()->get()->map(fn($item) => $item->setAttribute('type', 'characters')))
            ->merge($user->fruits()->get()->map(fn($item) => $item->setAttribute('type', 'fruits')))
            ->merge($user->weapons()->get()->map(fn($item) => $item->setAttribute('type', 'weapons')))
            ->merge($user->locations()->get()->map(fn($item) => $item->setAttribute('type', 'locations')))
            ->merge($user->organizations()->get()->map(fn($item) => $item->setAttribute('type', 'organizations')))
            ->merge($user->races()->get()->map(fn($item) => $item->setAttribute('type', 'races')));

        return view('favorites.index', compact('favorites'));
    }

    protected function resolveModelClass($type)
    {
        $models = [
            'characters' => Character::class,
            'fruits' => Fruit::class,
            'weapons' => Weapon::class,
            'locations' => Location::class,
            'organizations' => Organization::class,
            'races' => Race::class,
        ];

        return $models[$type] ?? abort(400, 'Invalid type');
    }
    

}
