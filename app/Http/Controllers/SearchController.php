<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;
use App\Models\Fruit;
use App\Models\Weapon;
use App\Models\Location;
use App\Models\Organization;
use App\Models\Race;
use Illuminate\Support\Collection;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return view('search.results', ['results' => collect(), 'query' => '']);
        }

        $models = [
            'Characters' => Character::class,
            'Fruits' => Fruit::class,
            'Weapons' => Weapon::class,
            'Locations' => Location::class,
            'Organizations' => Organization::class,
            'Races' => Race::class,
        ];

        $results = collect();

        foreach ($models as $key => $model) {
            $results->put($key, $model::where('name', 'like', "%{$query}%")->limit(10)->get());
        }

        return view('search.results', compact('results', 'query'));
    }
}
