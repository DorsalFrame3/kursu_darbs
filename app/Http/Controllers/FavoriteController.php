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
    protected $models = [
        'characters' => [
            'lv' => 'Varonis',
            'class' => Character::class,
            'route' => 'characters',
        ],
        'fruits' => [
            'lv' => 'Velna augļis',
            'class' => Fruit::class,
            'route' => 'fruits',
        ],
        'weapons' => [
            'lv' => 'Ieroce',
            'class' => Weapon::class,
            'route' => 'weapons',
        ],
        'locations' => [
            'lv' => 'Atrašanās vieta',
            'class' => Location::class,
            'route' => 'locations',
        ],
        'organizations' => [
            'lv' => 'Organizācija',
            'class' => Organization::class,
            'route' => 'organizations',
        ],
        'races' => [
            'lv' => 'Rase',
            'class' => Race::class,
            'route' => 'races',
        ],
    ];

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
        $favorites = collect();

        foreach ($this->models as $type => $info) {
            $items = $user->{$type}()->get();
            foreach ($items as $item) {
                $item->type = $type;
                $item->type_lv = $info['lv'];
                $favorites->push($item);
            }
        }

        return view('favorites.index', compact('favorites'));
    }

    protected function resolveModelClass($type)
    {
        if (!isset($this->models[$type])) {
            abort(400, 'Invalid type');
        }
        return $this->models[$type]['class'];
    }
}
