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

        // Ищем объекты по имени в разных моделях
        $characters = Character::where('name', 'like', '%' . $query . '%')->get();
        $fruits = Fruit::where('name', 'like', '%' . $query . '%')->get();
        $weapons = Weapon::where('name', 'like', '%' . $query . '%')->get();
        $locations = Location::where('name', 'like', '%' . $query . '%')->get();
        $organizations = Organization::where('name', 'like', '%' . $query . '%')->get();
        $races = Race::where('name', 'like', '%' . $query . '%')->get();

        // Возвращаем результаты на страницу
        return view('search.results', compact('characters', 'fruits', 'weapons', 'locations', 'organizations', 'races', 'query'));
    }
}