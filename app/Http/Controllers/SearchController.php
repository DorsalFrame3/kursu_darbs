<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;
use App\Models\Fruit;
use App\Models\Weapon;
use App\Models\Location;
use App\Models\Organization;
use App\Models\Race;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return view('search.results', ['results' => collect(), 'query' => '']);
        }

        $models = [
            [
                'lv' => 'Varonis',
                'model' => Character::class,
                'route' => 'characters',
            ],
            [
                'lv' => 'Velna augļis',
                'model' => Fruit::class,
                'route' => 'fruits',
            ],
            [
                'lv' => 'Ieroce',
                'model' => Weapon::class,
                'route' => 'weapons',
            ],
            [
                'lv' => 'Atrašanās vieta',
                'model' => Location::class,
                'route' => 'locations',
            ],
            [
                'lv' => 'Organizācija',
                'model' => Organization::class,
                'route' => 'organizations',
            ],
            [
                'lv' => 'Rase',
                'model' => Race::class,
                'route' => 'races',
            ],
        ];

        $results = collect();

        foreach ($models as $entry) {
            $items = $entry['model']::where('name', 'like', "%{$query}%")->limit(10)->get();

            if ($items->isNotEmpty()) {
                $results->put($entry['lv'], [
                    'route' => $entry['route'],
                    'items' => $items,
                ]);
            }
        }

        return view('search.results', compact('results', 'query'));
    }
}
