<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Models\Character;
use App\Models\Fruit;
use App\Models\Weapon;
use App\Models\Location;
use App\Models\Organization;
use App\Models\Race;

use App\Policies\AdminOnlyPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
            Character::class => AdminOnlyPolicy::class,
            Fruit::class => AdminOnlyPolicy::class,
            Weapon::class => AdminOnlyPolicy::class,
            Location::class => AdminOnlyPolicy::class,
            Organization::class => AdminOnlyPolicy::class,
            Race::class => AdminOnlyPolicy::class,
        ];
    public function boot(): void
    {
    
        $this->registerPolicies();

        Gate::define('create', [AdminOnlyPolicy::class, 'create']);

        Gate::define('update-character', [AdminOnlyPolicy::class, 'updateCharacter']);
        Gate::define('update-fruit', [AdminOnlyPolicy::class, 'updateFruit']);
        Gate::define('update-weapon', [AdminOnlyPolicy::class, 'updateWeapon']);
        Gate::define('update-location', [AdminOnlyPolicy::class, 'updateLocation']);
        Gate::define('update-organization', [AdminOnlyPolicy::class, 'updateOrganization']);
        Gate::define('update-race', [AdminOnlyPolicy::class, 'updateRace']);
    }
        
    }

