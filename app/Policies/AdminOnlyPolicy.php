<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Character;
use App\Models\Fruit;
use App\Models\Weapon;
use App\Models\Location;
use App\Models\Organization;
use App\Models\Race;

class AdminOnlyPolicy
{
    public function create(User $user)
    {
        return $user->role === 'admin';
    }

    // Character
    
    public function updateCharacter(User $user, Character $character)
    {
        return $user->role === 'admin';
    }

    // Fruit
    public function updateFruit(User $user, Fruit $fruit)
    {
        return $user->role === 'admin';
    }

    // Weapon
    public function updateWeapon(User $user, Weapon $weapon)
    {
        return $user->role === 'admin';
    }

    // Location
    public function updateLocation(User $user, Location $location)
    {
        return $user->role === 'admin';
    }

    // Organization
    public function updateOrganization(User $user, Organization $organization)
    {
        return $user->role === 'admin';
    }

    // Race
    public function updateRace(User $user, Race $race)
    {
        return $user->role === 'admin';
    }
}
